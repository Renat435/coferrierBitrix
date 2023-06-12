<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Профиль");

global $USER;

if (!$USER->IsAuthorized()) {
    header("Location: /");
    exit();
}
?>

<? $APPLICATION->IncludeComponent(
    "custom:profile",
    ".default",
    array(),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>