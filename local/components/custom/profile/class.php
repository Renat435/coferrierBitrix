<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Iblock\IblockTable;
use Bitrix\Catalog\Product\Price;

if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock")) {
    die();
}


class Profile extends CBitrixComponent implements Controllerable, Errorable
{
    protected int $userId;

    protected object $errorCollection;

    public function onPrepareComponentParams($arParams): array
    {
        global $USER;

        $this->userId = $USER->GetID();
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    private function getProfileInfo()
    {
        global $USER;

        $arUser = $USER->GetByID($this->userId)->Fetch();

        return [
            'NAME' => $arUser['NAME'],
            'LOGIN' => $arUser['LOGIN'],
            'PERSONAL_PHOTO' => CFile::GetPath($arUser['PERSONAL_PHOTO']),
            'PERSONAL_PHONE' => $arUser['PERSONAL_PHONE'],
        ];
    }

    private function getOrders()
    {
        $statusToClass = [
            'В очереди' => 'queue',
            'Готовится' => 'getting-ready',
            'Ожидает получения' => 'expectation',
            'Выполнен' => 'completed',
            'Отменён' => 'canceled',
        ];

        $arOrder= IblockTable::getRow([
            'filter' => ['CODE' => 'orders'],
            'select' => ['ID']
        ]);

        $arOrderID = $arOrder['ID'];

        $orders = CIBlockElement::GetList(
            array('ID' => 'ASC'),
            [
                'IBLOCK_ID' => $arOrderID,
                'ACTIVE' => 'Y',
                'PROPERTY_BUYER' => $this->userId,
            ],
            false,
            false,
            [
                'NAME',
                'PROPERTY_ORDER_STATUS',
                'PROPERTY_PLACE',
                'PROPERTY_BUYER',
                'PROPERTY_GOODS',
                'DATE_CREATE'
            ],
        );

        $result = [];

        while($order = $orders->fetch()){

            $result[$order['ID']]['ID'] = $order['ID'];
            $result[$order['ID']]['STATUS'] = $order['PROPERTY_ORDER_STATUS_VALUE'];
            $result[$order['ID']]['STATUS_CLASS'] = $statusToClass[$order['PROPERTY_ORDER_STATUS_VALUE']];
            $result[$order['ID']]['TOTAL_PRICE'] = $order['NAME'];
            $result[$order['ID']]['DATE_CREATE'] = explode(' ', $order['DATE_CREATE'])[0];

            $item = explode('&', $order['PROPERTY_GOODS_VALUE']);

            $id = intval($item[0]);
            $count = $item[2];

            $product = CIBlockElement::GetByID($id)->Fetch();

            $price = intval(CPrice::GetBasePrice($id)['PRICE']);


            $result[$order['ID']]['ELEMENTS'][] = [
                'NAME' => $product['NAME'],
                'COUNT' => $count,
                'PREVIEW_PICTURE' => CFile::GetPath($product['PREVIEW_PICTURE']),
                'PRICE' => $price,
            ];
        }

        return $result;
    }

    private function getArResult(): array
    {
        return [
            'PROFILE_INFO' => $this->getProfileInfo(),
            'ORDERS' => $this->getOrders(),
        ];
    }

    /**
     * Point of entry.
     */
    public function executeComponent(): void
    {
        $this->arResult = $this->getArResult();
        $this->includeComponentTemplate();
    }

    /**
     * Setting up routes.
     *
     * @return ActionFilter\HttpMethod[][][]
     */
    public function configureActions(): array
    {
        return [
            'changeInfo' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET,
                            ActionFilter\HttpMethod::METHOD_POST,
                        ]
                    ),
                ],
            ],
            'logout' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET,
                            ActionFilter\HttpMethod::METHOD_POST,
                        ]
                    ),
                ],
            ],
            'changePassword' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET,
                            ActionFilter\HttpMethod::METHOD_POST,
                        ]
                    ),
                ],
            ],
        ];
    }

    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code): \Bitrix\Main\Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    public function changeInfoAction()
    {
        $user = new CUser;

        $arFields = $_POST;

        if($arFields['PERSONAL_PHONE']){
            $filter = array(
                'PERSONAL_PHONE' => $arFields['PERSONAL_PHONE']
            );

            $params = array(
                'FIELDS' => array('ID')
            );

            $userQuery = CUser::GetList(($by="ID"), ($order="asc"), $filter, $params);

            if ($userQuery->SelectedRowsCount() > 0) {
                return [
                    'status' => false,
                    'message' => 'Пользователь с номером ' . $arFields['PERSONAL_PHONE'] . ' уже зарегистрирован',
                ];
            }
        }

        if($arFields['LOGIN']){
            $arFields['EMAIL'] = $arFields['LOGIN'];
        }

        if($_FILES['image']){
            $arFields['PERSONAL_PHOTO'] = $_FILES['image'];
        }

        if ($user->Update($this->userId, $arFields)) {
            return [
                'status' => true,
            ];
        }

        $error = strip_tags($user->LAST_ERROR);

        return [
            'status' => false,
            'message' => $error,
        ];

    }

    public function logoutAction()
    {
        global $USER;
        return $USER->Logout();
    }

    public function changePasswordAction($post)
    {
        $user = new CUser;
        $userFields = $user->GetByID($this->userId)->Fetch();

        $loginResult = $user->Login($userFields['LOGIN'], $post['current-password']);

        if($loginResult === true){

            $user->Update($this->userId, array('PASSWORD' => $post['new-password'], 'CONFIRM_PASSWORD' => $post['repeat-new-password']));

            if ($user->LAST_ERROR) {
                $error = strip_tags($user->LAST_ERROR);
                return [
                    'type' => 'error',
                    'message' => 'Ошибка при изменении пароля: '.$error,
                ];
            }

            return [
                'type' => 'success',
                'message' => 'Пароль успешно изменен для текущего пользователя',
            ];
        }

        return [
            'type' => 'error',
            'message' => 'Текущий пароль введен неверно',
        ];
    }
}