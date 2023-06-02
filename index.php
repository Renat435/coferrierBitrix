<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Главная');
?>

<? $APPLICATION->IncludeComponent(
    "custom:index.slider",
    ".default",
    array(),
    false
); ?>

    <section class="advantages" id="advantages">
        <div class="container">

            <h4 class="title">
                Нас выбирают за
            </h4>
            <div class="advantages__background"
                 style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/img/advantages__banner-img.jpg')"></div>

            <ul class="advantages__cards">
                <li class="advantages__card">
                    <img class="advantages__card-front" src="<?= SITE_TEMPLATE_PATH ?>/img/convenience.jpg"
                         alt="convenience">
                    <div class="advantages__card-back">
                        <p class="advantages__card-back-title">Удобство</p>
                        <svg class="advantages__card-back-icon" xmlns="http://www.w3.org/2000/svg" width="260"
                             height="39"
                             fill="none">
                            <path stroke="#fff" stroke-width="3"
                                  d="M130.091 14.99a200.702 200.702 0 0 1-11-5.758c-34-19.2-89.5 4.333-113 18.5-25.2 18.4 72.167-.828 124-12.742Zm0 0c42.292 20.534 100.648 31.759 124.5 9.742 26-24-90.5-19.485-124.5-9.742Z"/>
                        </svg>
                        <p class="advantages__card-back-text">
                            На сайте вы можете увидеть весь ассортимент товаров.
                        </p>
                    </div>
                </li>
                <li class="advantages__card">
                    <img class="advantages__card-front" src="<?= SITE_TEMPLATE_PATH ?>/img/speed.jpg" alt="speed">
                    <div class="advantages__card-back">
                        <p class="advantages__card-back-title">Скорость</p>
                        <svg class="advantages__card-back-icon" xmlns="http://www.w3.org/2000/svg" width="33"
                             height="89" fill="none">
                            <path stroke="#fff" stroke-width="3" d="m20.5 1.5-17 43 26-12-26 55"/>
                        </svg>
                        <p class="advantages__card-back-text">
                            Вы можете заказать сделать заказ используя телефон и к вашему приходу, заказ будет готов
                        </p>
                    </div>
                </li>
                <li class="advantages__card">
                    <img class="advantages__card-front" src="<?= SITE_TEMPLATE_PATH ?>/img/quality.jpg" alt="quality">
                    <div class="advantages__card-back">
                        <p class="advantages__card-back-title">Качество</p>
                        <svg class="advantages__card-back-icon" xmlns="http://www.w3.org/2000/svg" width="56"
                             height="61"
                             fill="none">
                            <path stroke="#fff"
                                  d="M43.23 39.105c-3.334 5.775-8.076 9.986-13.028 12.138-4.951 2.152-10.077 2.234-14.245-.172-4.168-2.407-6.66-6.887-7.272-12.25-.612-5.365.663-11.578 3.998-17.353 3.335-5.776 8.077-9.987 13.029-12.139 4.951-2.152 10.077-2.234 14.245.172 4.168 2.407 6.66 6.887 7.272 12.251.612 5.364-.663 11.577-3.998 17.353Z"/>
                            <path stroke="#fff"
                                  d="M13.36 49.29c6.25-.327 17.801-4.267 14.013-17.404C23.585 18.75 34.505 11.58 40.44 9.636"/>
                        </svg>
                        <p class="advantages__card-back-text">
                            Мы вкладываем душу в каждый заказ
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section class="gallery">
        <div class="container">
            <ul class="gallery__grid">
                <li class="gallery__grid-item">
                    <a class="gallery__grid-item-link" data-fslightbox="gallery"
                       href="<?= SITE_TEMPLATE_PATH ?>/img/gallery-1.jpg">
                        <img class="gallery__grid-item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-1.jpg"
                             alt="gallery-1">
                    </a>
                    <div class="gallery__grid-item-hover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/loupe.svg" alt="loupe">
                    </div>
                </li>
                <li class="gallery__grid-item">
                    <a class="gallery__grid-item-link" data-fslightbox="gallery"
                       href="<?= SITE_TEMPLATE_PATH ?>/img/gallery-2.jpg">
                        <img class="gallery__grid-item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-2.jpg"
                             alt="gallery-2">
                    </a>
                    <div class="gallery__grid-item-hover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/loupe.svg" alt="loupe">
                    </div>
                </li>
                <li class="gallery__grid-item">
                    <a class="gallery__grid-item-link" data-fslightbox="gallery"
                       href="<?= SITE_TEMPLATE_PATH ?>/img/gallery-3.jpg">
                        <img class="gallery__grid-item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-3.jpg"
                             alt="gallery-3">
                    </a>
                    <div class="gallery__grid-item-hover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/loupe.svg" alt="loupe">
                    </div>
                </li>
                <li class="gallery__grid-item">
                    <a class="gallery__grid-item-link" data-fslightbox="gallery"
                       href="<?= SITE_TEMPLATE_PATH ?>/img/gallery-4.jpg">
                        <img class="gallery__grid-item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-4.jpg"
                             alt="gallery-4">
                    </a>
                    <div class="gallery__grid-item-hover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/loupe.svg" alt="loupe">
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <? $APPLICATION->IncludeComponent(
        "custom:index.places",
        ".default",
        array(),
        false
    ); ?>


    <? $APPLICATION->IncludeComponent(
        "custom:index.contacts",
        ".default",
        array(),
        false
    ); ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>