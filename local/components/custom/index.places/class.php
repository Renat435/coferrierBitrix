<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Errorable;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Iblock\IblockTable;

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
        $arIblock = IblockTable::getRow([
            'filter' => ['CODE' => 'cafe'],
            'select' => ['ID']
        ]);

        $iblockId = $arIblock['ID'];

        $filter = array(
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y'
        );

        $selectFields = array(
            'ID',
            'NAME',
        );

        $propertyFields = array();
        $propertyList = CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $iblockId));
        while ($property = $propertyList->Fetch()) {
            $propertyFields[] = 'PROPERTY_' . $property['CODE'];
        }

        $selectFields = array_merge($selectFields, $propertyFields);

        $result = CIBlockElement::GetList(
            array('ID' => 'ASC'),
            $filter,
            false,
            false,
            $selectFields
        );

        $arResult = [];

        while ($arItem = $result->Fetch()) {
            $gps = explode(",", $arItem['PROPERTY_CAFE_ADDRESS_VALUE']);
            $arResult[] = [
                'ID' => $arItem['ID'],
                'TITLE' => $arItem['NAME'],
                'ADDRESS' => $arItem['NAME'],
                'GPS_N' => $gps[0],
                'GPS_S' => $gps[1],
                'IMAGE' => CFile::GetPath($arItem['PROPERTY_CAFE_IMAGE_VALUE']),
                'SCHEDULE' => $arItem['PROPERTY_CAFE_SCHEDULE_VALUE'],
                'PHONE' => $arItem['PROPERTY_CAFE_PHONE_VALUE'],
            ];
        }

        return $arResult;
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
    }
}