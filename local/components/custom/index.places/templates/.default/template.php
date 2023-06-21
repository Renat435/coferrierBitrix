<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php
echo '<pre>';
print_r($arResult);
echo '</pre>';
?>

<section class="places">

    <svg class="places__waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
        </defs>
        <g class="places__parallax">
            <use xlink:href="#gentle-wave" x="48" y="0"/>
            <use xlink:href="#gentle-wave" x="48" y="3"/>
            <use xlink:href="#gentle-wave" x="48" y="5"/>
            <use xlink:href="#gentle-wave" x="48" y="7"/>
        </g>
    </svg>

    <div class="container">
        <h3 class="title places__title">
            Места где вы можете забрать заказ, и хорошо провести время
        </h3>

        <div id="places__map" class="places__map"></div>

        <div class="places__slider-wrapper">
            <div class="swiper places__slider">
                <div class="swiper-wrapper">
                    <?php foreach ($arResult['PLACES'] as $item):?>
                        <div class="swiper-slide">
                            <div class="places__slider-item">
                                <img class="places__slider-item-img" src="<?=$item['IMAGE']?>"
                                     alt="<?=$item['TITLE']?>">
                                <ul class="places__slider-item-info">
                                    <li class="places__slider-item-info-item">
                                        <svg class="places__slider-item-info-item-icon" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.99999 2.16797C6.91234 2.16797 4.40906 4.67109 4.40906 7.75891C4.40906 11.3736 9.06812 17.832 9.99999 17.832C10.932 17.832 15.5908 11.3736 15.5908 7.75891C15.5908 4.67109 13.0878 2.16797 9.99999 2.16797ZM9.99999 10.908C8.25218 10.908 6.83499 9.49078 6.83499 7.74297C6.83499 5.995 8.25218 4.57797 9.99999 4.57797C11.7481 4.57797 13.165 5.99516 13.165 7.74297C13.165 9.49063 11.7481 10.908 9.99999 10.908Z"/>
                                        </svg>
                                        <p class="places__slider-item-info-item-text">
                                            <?=$item['ADDRESS']?>
                                        </p>
                                    </li>
                                    <li class="places__slider-item-info-item">
                                        <svg class="places__slider-item-info-item-icon" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_47_15)">
                                                <path d="M10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM9 10.41V4H11V9.59L14.95 13.54L13.54 14.95L9 10.41Z"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_47_15">
                                                    <rect width="20" height="20" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="places__slider-item-info-item-text">
                                            <?=$item['SCHEDULE']?>
                                        </p>
                                    </li>
                                    <li class="places__slider-item-info-item">
                                        <svg class="places__slider-item-info-item-icon" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_47_18)">
                                                <path d="M12.7063 13.425L14.1063 12.025C14.2948 11.8388 14.5334 11.7113 14.793 11.6581C15.0526 11.6048 15.3221 11.6281 15.5688 11.725L17.275 12.4063C17.5243 12.5074 17.738 12.6801 17.8893 12.9026C18.0405 13.125 18.1226 13.3873 18.125 13.6563V16.7813C18.1236 16.9643 18.0851 17.1451 18.0119 17.3128C17.9388 17.4805 17.8324 17.6317 17.6993 17.7573C17.5662 17.8828 17.409 17.9801 17.2373 18.0433C17.0655 18.1065 16.8828 18.1343 16.7 18.125C4.74377 17.3813 2.33127 7.25628 1.87502 3.38128C1.85384 3.19099 1.87319 2.99837 1.9318 2.81609C1.99041 2.63382 2.08695 2.46602 2.21506 2.32374C2.34318 2.18145 2.49997 2.0679 2.67512 1.99057C2.85027 1.91323 3.03981 1.87385 3.23127 1.87503H6.25002C6.5194 1.87582 6.78239 1.95719 7.00514 2.10867C7.2279 2.26015 7.40025 2.4748 7.50002 2.72503L8.18127 4.43128C8.28143 4.67694 8.30698 4.94668 8.25474 5.20678C8.2025 5.46689 8.07477 5.70584 7.88752 5.89378L6.48752 7.29378C6.48752 7.29378 7.29377 12.75 12.7063 13.425Z"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_47_18">
                                                    <rect width="20" height="20" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>


                                        <a class="places__slider-item-info-item-text" href="tel:<?=$item['PHONE']?>">
                                            <?=$item['PHONE']?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="places__slider-item-btn-wrapper">
                                    <button class="places__slider-item-btn" data-placemark-id="<?=$item['ID']?>" type="button">
                                        <p class="places__slider-item-btn-text">
                                            Показать на карте
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>

                </div>
                <div class="places__slider-pagination"></div>

                <div class="places__slider-button places__slider-button--prev">
                    <svg width="34" height="24" viewBox="0 0 34 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.939339 10.9393C0.353554 11.5251 0.353554 12.4749 0.939339 13.0607L10.4853 22.6066C11.0711 23.1924 12.0208 23.1924 12.6066 22.6066C13.1924 22.0208 13.1924 21.0711 12.6066 20.4853L4.12132 12L12.6066 3.51472C13.1924 2.92893 13.1924 1.97919 12.6066 1.3934C12.0208 0.807611 11.0711 0.807611 10.4853 1.3934L0.939339 10.9393ZM34 10.5L2 10.5V13.5L34 13.5V10.5Z"/>
                    </svg>
                </div>
                <div class="places__slider-button places__slider-button--next">
                    <svg width="34" height="24" viewBox="0 0 34 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.0607 13.0607C33.6464 12.4749 33.6464 11.5251 33.0607 10.9393L23.5147 1.3934C22.9289 0.807609 21.9792 0.80761 21.3934 1.3934C20.8076 1.97918 20.8076 2.92893 21.3934 3.51472L29.8787 12L21.3934 20.4853C20.8076 21.0711 20.8076 22.0208 21.3934 22.6066C21.9792 23.1924 22.9289 23.1924 23.5147 22.6066L33.0607 13.0607ZM1.31134e-07 13.5L32 13.5L32 10.5L-1.31134e-07 10.5L1.31134e-07 13.5Z"/>
                    </svg>
                </div>
            </div>

        </div>
    </div>

    <svg class="places__waves places__waves--bottom" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
        </defs>
        <g class="places__parallax">
            <use xlink:href="#gentle-wave" x="48" y="0"/>
            <use xlink:href="#gentle-wave" x="48" y="3"/>
            <use xlink:href="#gentle-wave" x="48" y="5"/>
            <use xlink:href="#gentle-wave" x="48" y="7"/>
        </g>
    </svg>
</section>