<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\UserTable;

if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock") or !Loader::includeModule("main")) {
    die();
}

class HeaderRegistration extends CBitrixComponent implements Controllerable, Errorable
{
    protected object $errorCollection;

    public function onPrepareComponentParams($arParams): array
    {
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    /**
     * Point of entry.
     */
    public function executeComponent(): void
    {
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
            'registration' => [
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

    public function registrationAction($post)
    {

        $filter = array(
            'PERSONAL_PHONE' => $post['phone']
        );

        $params = array(
            'FIELDS' => array('ID')
        );

        $userQuery = CUser::GetList(($by="ID"), ($order="asc"), $filter, $params);

        if ($userQuery->SelectedRowsCount() > 0) {
            return [
                'type' => 'error',
                'error' => 'Пользователь с номером ' . $post['phone'] . ' уже зарегистрирован',
            ];
        }

        $imagePath = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/img/default_user_icon.png';

        $userFields = array(
            'NAME' => $post['name'],
            'EMAIL' => $post['login'],
            'LOGIN' => $post['login'],
            'PASSWORD' => $post['password'],
            'CONFIRM_PASSWORD' => $post['repeat-password'],
            'PERSONAL_PHONE' => $post['phone'],
            'PERSONAL_PHOTO' => CFile::MakeFileArray($imagePath),
        );

        $user = new CUser;

        $newUserId = $user->Add($userFields);

        if (intval($newUserId) > 0) {
            $user->Authorize($newUserId);
            return [
                'type' => 'success',
            ];
        }

        $error = strip_tags($user->LAST_ERROR);

        return [
            'type' => 'error',
            'error' => "Ошибка регистрации пользователя: " . $error,
        ];

    }
}