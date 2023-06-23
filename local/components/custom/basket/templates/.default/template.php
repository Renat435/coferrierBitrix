<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="basket">
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/">Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/basket/">Корзина</a>
            </li>
        </ul>
        <h3 class="page-title">
            Корзина
        </h3>

        <?php if(count($arResult['BASKET']['GOODS']) > 0):?>

        <div class="basket__places">
            <div id="basket-map" class="basket__places-map"></div>
            <div class="basket__places-list">

                <?php foreach ($arResult['PLACES'] as $key => $item):?>

                    <label class="basket__places-list-item">
                        <input class="basket__places-list-item-input" type="radio" name="basket-places" <?=($key === 0) ? 'checked' : ''?>>
                        <span class="basket__places-list-item-address" data-placemark-id-label="<?=$item['ID']?>">
                            <?=$item['ADDRESS']?>
                        </span>
                    </label>

                <?php endforeach;?>

            </div>
        </div>

        <div class="basket__info">

            <ul class="basket__info-list">

                <?php foreach ($arResult['BASKET']['GOODS'] as $item):?>

                <li class="basket__info-list-item" data-id="<?=$item['ID']?>">
                    <img class="basket__info-list-item-image" src="<?=$item['PREVIEW_PICTURE']?>" alt="">
                    <div class="basket__info-list-item-info">
                        <p class="basket__info-list-item-info-name">
                            <?=$item['NAME']?>
                        </p>
                        <div class="basket__info-list-item-info-price">
                            <p class="basket__info-list-item-info-price-text">Цена: <span class="price"><?=$item['PRICE']?></span>р</p>
                            <div class="basket__info-list-item-info-price-block">
                                <button class="basket__info-list-item-info-price-block-minus">-</button>
                                <p class="basket__info-list-item-info-price-block-counter"><?=$item['QUANTITY']?></p>
                                <button class="basket__info-list-item-info-price-block-plus">+</button>
                            </div>
                            <p class="basket__info-list-item-info-price-text">
                                Итого: <span class="total-price price"><?=$item['TOTAL_PRICE']?></span>р
                            </p>
                        </div>
                    </div>
                    <button class="basket__info-list-item-delete" type="button" data-id="<?=$item['ID']?>">Удалить</button>
                </li>

                <?php endforeach;?>

            </ul>


            <div class="basket__info-order">
                <p class="basket__info-order-item basket__info-order-attention">
                    Максимальная сумма заказа <span class="fat">1500р</span>
                </p>
                <p class="basket__info-order-item basket__info-order-place">
                    <span class="fat">Адрес:</span> <span id="order-address"><?=$arResult['PLACES'][0]['ADDRESS']?></span>
                </p>
                <p class="basket__info-order-item basket__info-order-time">
                    <span class="fat">Примерное время ожидания:</span>
                    <span id="order-time" class="time <?=$arResult['PLACES'][0]['WORKLOAD']['CLASS']?>">
                        <span id="order-time-number">
                            <?=$arResult['PLACES'][0]['WORKLOAD']['TIME']?>
                        </span>
                        минут
                    </span>
                </p>
                <p class="basket__info-order-item basket__info-order-price">
                    <span class="fat">Цена:</span>
                    <span id="total-price"><?=$arResult['BASKET']['TOTAL_PRICE']?></span>р
                </p>
                <p class="basket__info-order-item">
                    <span class="fat">Номер телефона:</span>
                    <a class="basket__info-order-item-phone" href="tel: <?=$arResult['PLACES'][0]['PHONE']?>">
                        <?=$arResult['PLACES'][0]['PHONE']?>
                    </a>
                </p>
                <button class="basket__info-order-button" type="button">Заказать</button>
            </div>

        </div>

        <?php else:?>

        <div class="basket__empty">
            <h3 class="basket__empty-title">Ваша корзина пуста:(</h3>
            <a class="basket__empty-link" href="/catalog/">Перейти в каталог</a>
        </div>

        <?php endif;?>

    </div>
</section>