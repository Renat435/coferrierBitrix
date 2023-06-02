<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Bitrix\Catalog\StoreTable;
use Bitrix\Main\Errorable;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;

if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock") or ! Loader::includeModule('catalog')) {
    die();
}

class IndexPlaces extends CBitrixComponent implements Controllerable, Errorable
{
    protected object $errorCollection;

    public function onPrepareComponentParams($arParams): array
    {
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    private function getPlaces()
    {
        $storeManager = StoreTable::getList([
            'select' => [
                'ID',
                'IMAGE_ID',
                'TITLE',
                'ADDRESS',
                'SCHEDULE',
                'PHONE',
                'GPS_N',
                'GPS_S',
            ],
        ]);

        $stores = [];

        while ($store = $storeManager->fetch())
        {
            $store['IMAGE'] = CFile::GetPath($store['IMAGE_ID']);
            $stores[] = $store;
        }
        return $stores;
    }

    /**
     * Point of entry.
     */
    public function executeComponent(): void
    {
        $this->arResult['PLACES'] = $this->getPlaces();

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
            'getPlacesJS' => [
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

    public function getPlacesJSAction()
    {
        return $this->getPlaces();


        return [
            'PLACES' => $this->getPlaces(),
            'TEMPLATE_PATH' => Application::getInstance()->getContext()->getSite()->getDocumentRoot(),
        ];
    }
}