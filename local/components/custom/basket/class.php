<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Errorable;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;


if (
    !defined("B_PROLOG_INCLUDED") or
    B_PROLOG_INCLUDED !== true or
    !Loader::includeModule("iblock") or
    !Loader::includeModule("sale") or
    !Loader::includeModule("catalog")
) {
    die();
}

class BasketComponent extends CBitrixComponent implements Controllerable, Errorable
{
    protected int $userId;
    protected object $errorCollection;
    protected object $basket;

    public function onPrepareComponentParams($arParams): array
    {
        global $USER;
        $this->basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());
        $this->userId = $USER->GetID();
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    private function getPlaces()
    {

        $arOrder= IblockTable::getRow([
            'filter' => ['CODE' => 'orders'],
            'select' => ['ID']
        ]);

        $arOrderID = $arOrder['ID'];

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

            $orders = CIBlockElement::GetList(
                array('ID' => 'ASC'),
                [
                    'IBLOCK_ID' => $arOrderID,
                    'ACTIVE' => 'Y',
                    'PROPERTY_ORDER_STATUS_VALUE' => 'В очереди',
                    'PROPERTY_PLACE' => $arItem['ID'],
                ],
                false,
                false,
                [
                    'PROPERTY_ORDER_STATUS',
                    'PROPERTY_PLACE'
                ],
            );

            $count = 0;

            while($order = $orders->fetch()){
                $count += 1;
            }

            $gps = explode(",", $arItem['PROPERTY_CAFE_ADDRESS_VALUE']);

            $workload = [];

            if($count >= 5){
                $workload['TIME'] = 30;
                $workload['CLASS'] = 'long';
            } else if ($count > 2){
                $workload['TIME'] = 15;
                $workload['CLASS'] = 'medium';
            } else{
                $workload['TIME'] = 5;
                $workload['CLASS'] = 'fast';
            }

            $arResult[] = [
                'ID' => $arItem['ID'],
                'TITLE' => $arItem['NAME'],
                'ADDRESS' => $arItem['NAME'],
                'GPS_N' => $gps[0],
                'GPS_S' => $gps[1],
                'IMAGE' => CFile::GetPath($arItem['PROPERTY_CAFE_IMAGE_VALUE']),
                'SCHEDULE' => $arItem['PROPERTY_CAFE_SCHEDULE_VALUE'],
                'PHONE' => $arItem['PROPERTY_CAFE_PHONE_VALUE'],
                'WORKLOAD' => $workload,
            ];
        }

        return $arResult;
    }

    public function getBasket()
    {
        $basketItems = $this->basket->getBasketItems();

        $totalPrice = 0;
        $result = [];

        foreach ($basketItems as $basketItem) {
            $productId = $basketItem->getProductId();

            $price = $basketItem->getPrice();
            $quantity = $basketItem->getQuantity();

            $result[$productId]['NAME'] = $basketItem->getField('NAME');
            $result[$productId]['QUANTITY'] = $quantity;
            $result[$productId]['PRICE'] = $price;
            $result[$productId]['TOTAL_PRICE'] = $price * $quantity;
            $totalPrice += $price * $quantity;
            $productId = $basketItem->getProductId();
            $result[$productId]['ID'] = $productId;
            $result[$productId]['PREVIEW_PICTURE'] = $basketItem->getField('PREVIEW_PICTURE');

            $product = ElementTable::getList([
                'select' => ['ID', 'PREVIEW_PICTURE'],
                'filter' => ['ID' => $productId],
            ])->fetch();

            $result[$productId]['PREVIEW_PICTURE'] = CFile::GetPath($product['PREVIEW_PICTURE']);

        }
        return [
            'GOODS' => $result,
            'TOTAL_PRICE' => $totalPrice,
        ];
    }

    private function getArResult(): array
    {
        return [
            'BASKET' => $this->getBasket(),
            'PLACES' => $this->getPlaces(),
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
            'deleteElementFromBasket' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET,
                            ActionFilter\HttpMethod::METHOD_POST,
                        ]
                    ),
                ],
            ],
            'getPlacesToJS' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET,
                            ActionFilter\HttpMethod::METHOD_POST,
                        ]
                    ),
                ],
            ],
            'addNewOrder' => [
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

    public function deleteElementFromBasketAction($post)
    {
        $basketItems = $this->basket->getBasketItems();

        foreach ($basketItems as $basketItem) {
            $productId = $basketItem->getProductId();

            if($productId === intval($post)){
                $basketItem->delete();
                $this->basket->save();
                return true;
            }
        }

        return false;
    }

    public function getPlacesToJSAction()
    {
        return $this->getPlaces();
    }

    public function addNewOrderAction($post)
    {
        $arOrder= IblockTable::getRow([
            'filter' => ['CODE' => 'orders'],
            'select' => ['ID']
        ]);

        $arOrderID = $arOrder['ID'];

        $el = new CIBlockElement;

        $fields = array(
            "IBLOCK_ID" => $arOrderID,
            "NAME" => $post['totalPrice'],
            "PROPERTY_VALUES" => array(
                'GOODS' => $post['items'],
                'PLACE' => $post['addressId'],
                'BUYER' => $this->userId,
                'ORDER_STATUS' => 3,
            )
        );

        if ($newElementId = $el->Add($fields)) {
            CSaleBasket::DeleteAll($this->userId);
            return true;
        }

        return false;

    }
}