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
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/swiper-bundle.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/fslightbox.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/simplebar.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
    // css
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/reset.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/swiper-bundle.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.min.css');

    $APPLICATION->ShowHead();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= $APPLICATION->ShowTitle() ?></title>
</head>
<body>

<?php
$APPLICATION->ShowPanel();
?>

<div class="preloader">
    <div class="spinner"></div>
</div>

<div class="body__inner">
    <header class="header" style="<?= (CUser::IsAuthorized()) ? 'position: relative' : '' ?>">
        <div class="container">
            <div class="header__inner">
                <a href="/">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/Logo.svg" alt="logo">
                </a>
                <div class="header__input-search">
                    <input class="header__input-search-input" type="text" maxlength="20" data-input-move>
                    <p class="header__input-search-text">Поиск</p>
                </div>
                <? $APPLICATION->IncludeComponent("bitrix:menu", "header_menu", array(
                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                    false
                ); ?>
                <?php if (CUser::IsAuthorized()): ?>
                    <div class="header__authorized">
                        <a href="#">
                            <img src="assets/img/basket-icon.svg" alt="">
                        </a>
                        <a class="header__authorized-profile" href="">
                            <img class="header__authorized-profile-image" src="<?= SITE_TEMPLATE_PATH ?>/img/svg/default_user_icon.svg" alt="">
                        </a>
                    </div>
                <?php else: ?>
                    <div class="header__not-authorized">
                        <button class="header__not-authorized-link popup-link" data-popup-name="sign-in" type="button">
                            Вход
                        </button>
                        <button class="header__not-authorized-link popup-link" data-popup-name="registration"
                                type="button">
                            Регистрация
                        </button>
                    </div>
                    <? $APPLICATION->IncludeComponent(
                        "custom:header.login",
                        ".default",
                        array(),
                        false
                    ); ?>

                    <div class="popup" data-popup-name="registration">
                        <div class="popup__inner">
                            <div class="popup__close-area"></div>
                            <div class="popup__body">
                                <h4 class="popup__title">
                                    Регистрация
                                </h4>
                                <button class="popup__close-btn" type="button">
                                    <img src="assets/img/close-btn.svg" alt="">
                                </button>
                                <div class="header__popup-inner">
                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input" type="text"
                                                   maxlength="20" data-input-move>
                                            <p class="header__input-search-text">Поиск</p>
                                        </div>
                                    </div>
                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input" type="text"
                                                   maxlength="20" data-input-move>
                                            <p class="header__input-search-text">Поиск</p>
                                        </div>
                                    </div>
                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input" type="text"
                                                   maxlength="20" data-input-move>
                                            <p class="header__input-search-text">Поиск</p>
                                        </div>
                                    </div>
                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input" type="text"
                                                   maxlength="20" data-input-move>
                                            <p class="header__input-search-text">Поиск</p>
                                        </div>
                                    </div>
                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input" type="text"
                                                   maxlength="20" data-input-move>
                                            <p class="header__input-search-text">Поиск</p>
                                        </div>
                                    </div>
                                    <button class="popup-save-btn" type="button">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </header>
    <main>
