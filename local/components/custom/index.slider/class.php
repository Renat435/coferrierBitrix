<?php

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\FileTable;

if (! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or ! Loader::includeModule("iblock")) {
    die();
}

class IndexSlider extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

    private function getSliderItems()
    {
        $iblockCode = 'index_slider';
        $filter = ['CODE' => $iblockCode];
        $select = ['ID'];

        $arIblock = IblockTable::getRow([
            'filter' => $filter,
            'select' => $select
        ]);

        $iblockId = $arIblock['ID'];

        $filter = ['IBLOCK_ID' => $iblockId];
        $select = ['NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT'];

        $arResult = [];

        $rsElements = ElementTable::getList([
            'filter' => $filter,
            'select' => $select
        ]);

        while ($arElement = $rsElements->fetch()) {
            if ($arElement["PREVIEW_PICTURE"]) {
                $arFile = FileTable::getRowById($arElement["PREVIEW_PICTURE"]);
                $arElement["PREVIEW_PICTURE"] = CFile::GetPath($arFile["ID"]);
            }
            $arResult[] = $arElement;
        }
        return $arResult;
    }

    /**
     * Point of entry.
     */
    public function executeComponent(): void
    {
        $this->arResult['SLIDER_ITEMS'] = $this->getSliderItems();

        $this->includeComponentTemplate();
    }
}