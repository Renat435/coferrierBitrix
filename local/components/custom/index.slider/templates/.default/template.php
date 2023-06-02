<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="stock" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/stock-bg.png')">
    <div class="container">

        <div class="stock__slider-wrapper">
            <div class="swiper stock__slider">
                <div class="swiper-wrapper">

                    <?php foreach ($arResult['SLIDER_ITEMS'] as $sliderItem):?>

                        <div class="swiper-slide">
                            <div class="stock__info">
                                <p class="stock__info-text">
                                    <?=$sliderItem['NAME']?>
                                </p>
                                <p class="stock__info-text">
                                    <?=$sliderItem['PREVIEW_TEXT']?>
                                </p>
                            </div>
                            <img class="stock__banner" src="<?=$sliderItem['PREVIEW_PICTURE']?>" alt="">
                        </div>
                    <?php endforeach;?>


                </div>
            </div>
            <div class="stock__slider-pagination"></div>
            <div class="stock__slider-timer">
                <div class="stock__slider-timer-progress active"></div>
            </div>
        </div>

        <div class="swiper stock__slogans">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <p class="stock__slogans-text">
                        Просыпайтесь и вдыхайте запах кофе
                    </p>
                </div>
                <div class="swiper-slide">
                    <p class="stock__slogans-text">
                        Coferrier - cпасатель вашего утра
                    </p>
                </div>
                <div class="swiper-slide">
                    <p class="stock__slogans-text">
                        Пусть кофе подействует раньше, чем это сделает реальность
                    </p>
                </div>
            </div>
        </div>

        <button class="stock__next" type="button">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm4.707,13.707-4,4a1,1,0,0,1-1.414,0l-4-4a1,1,0,1,1,1.414-1.414L11,15.586V6a1,1,0,0,1,2,0v9.586l2.293-2.293a1,1,0,0,1,1.414,1.414Z"/>
            </svg>
        </button>

    </div>
</section>