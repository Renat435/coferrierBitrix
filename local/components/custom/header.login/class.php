<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;

if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock")) {
    die();
}

class HeaderLogin extends CBitrixComponent implements Controllerable, Errorable
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
            'login' => [
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

    public function loginAction($post)
    {
        global $USER;
        $authResult = $USER->Login($post['login'], $post['password']);

        if ($authResult === true) {
            return true;
        }
        return false;
    }
}