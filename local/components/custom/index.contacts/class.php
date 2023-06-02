<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Errorable;
use Bitrix\Main\Loader;


if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock")) {
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
// Получатель
        $toEmail = 'renatparastaev@bk.ru';

// Тема письма
        $subject = 'Тестовое сообщение';

// Текст письма
        $message = 'Привет, это тестовое сообщение!';

// Отправка письма
        Event::send(array(
            "EVENT_NAME" => "SEND_MAIL",
            "LID" => "s1",
            "C_FIELDS" => array(
                "EMAIL_TO" => $toEmail,
                "SUBJECT" => $subject,
                "MESSAGE" => $message,
            ),
        ));

//        return $post;
    }
}