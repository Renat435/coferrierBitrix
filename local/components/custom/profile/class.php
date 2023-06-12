<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;

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

    private function getArResult(): array
    {
        return [
            'PROFILE_INFO' => $this->getProfileInfo(),
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

        return [
            'status' => false,
            'message' => preg_replace('/<br\s?\/?>/', '', $user->LAST_ERROR),
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
                return [
                    'type' => 'error',
                    'message' => 'Ошибка при изменении пароля: '.$user->LAST_ERROR,
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