<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Errorable;
use Bitrix\Main\Loader;


if (!defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or !Loader::includeModule("iblock")) {
    die();
}

class IndexContacts extends CBitrixComponent implements Controllerable, Errorable
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
        global $USER;

        if ($USER->IsAuthorized()) {
            $this->arResult['USER'] = [
                'EMAIL' => $USER->GetEmail(),
                'NAME' => $USER->GetFirstName(),
            ];
        }


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
            'sendMessage' => [
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

    public function sendMessageAction($post)
    {
        $iblockCode = 'messages';

        $filter = ['CODE' => $iblockCode];
        $select = ['ID'];

        $arIblock = IblockTable::getRow([
            'filter' => $filter,
            'select' => $select
        ]);

        $iblockId = $arIblock['ID'];

        $fields = array(
            "IBLOCK_ID" => $iblockId,
            "NAME" => $post['name'],
            "PREVIEW_TEXT" => $post['message'],
            "PROPERTY_VALUES" => array(
                "EMAIL" => $post['email']
            )
        );

        $element = new CIBlockElement;
        $elementId = $element->Add($fields);

        if ($elementId) {
            return [
                'type' => 'success',
                'message' => 'Ваше сообщение успешно отправлено',
            ];
        }
        return [
            'type' => 'error',
            'message' => 'Ошибка при отправке сообщения',
        ];
    }
}