<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$CurDir = $APPLICATION->GetCurDir();
$CurUri = $APPLICATION->GetCurUri();
?>
<!doctype html>
<html lang="ru">
<head>
    <?php
    use Bitrix\Main\Page\Asset;
    // js
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
    // css
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/reset.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.min.css');

    $APPLICATION->ShowHead();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?=$APPLICATION->ShowTitle()?></title>
</head>
<body>

<?php
    $APPLICATION->ShowPanel();
?>

