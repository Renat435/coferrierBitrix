<?
global $APPLICATION;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<?php
$APPLICATION->IncludeComponent(
    'custom:basket',
    '.default',
    [],
    false,
)
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>