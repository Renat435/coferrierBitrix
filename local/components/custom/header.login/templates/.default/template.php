<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<div class="popup" data-popup-name="sign-in">
    <div class="popup__inner">
        <div class="popup__close-area"></div>
        <div class="popup__body">
            <h4 class="popup__title">
                Вход
            </h4>
            <button class="popup__close-btn" type="button">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/svg/close-btn.svg" alt="close">
            </button>
            <form id="header-sign-in-form" class="header__popup-inner">
                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input id="header-input-login" class="header__input-search-input input-popup__input" type="text"
                               maxlength="40" data-input-move>
                        <p class="header__input-search-text">Email</p>
                    </div>
                </div>

                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input id="header-input-password" class="header__input-search-input input-popup__input" type="password"
                               maxlength="20" data-input-move>
                        <p class="header__input-search-text">Пароль</p>
                        <button class="password-show-hide" type="button">
                            <img class="password-show-hide__img" src="<?=SITE_TEMPLATE_PATH?>/img/svg/eye.svg" alt="eye">
                        </button>
                    </div>
                </div>

                <button id="header-login-btn" class="popup-save-btn" type="submit">
                    Войти
                </button>
            </form>
        </div>
    </div>
</div>