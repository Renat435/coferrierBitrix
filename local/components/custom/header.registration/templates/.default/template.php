<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="popup" data-popup-name="registration">
    <div class="popup__inner">
        <div class="popup__close-area"></div>
        <div class="popup__body">
            <h4 class="popup__title">
                Регистрация
            </h4>
            <button class="popup__close-btn" type="button">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/svg/close-btn.svg" alt="close">
            </button>
            <form id="registration-form" class="header__popup-inner">
                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input class="header__input-search-input input-popup__input" type="email" name="login" value="ignat322@mail.ru"
                               maxlength="40" data-input-move>
                        <p class="header__input-search-text">Логин / email</p>
                    </div>
                </div>
                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input class="header__input-search-input input-popup__input" type="text" name="name" value="Игнат"
                               maxlength="20" data-input-move>
                        <p class="header__input-search-text">Имя</p>
                    </div>
                </div>
                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input class="header__input-search-input input-popup__input" type="text" name="phone" value="8 (988) 836-85-16"
                               maxlength="17" data-input-move data-phone-pattern>
                        <p class="header__input-search-text">Номер телефона</p>
                    </div>
                </div>


                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input class="header__input-search-input input-popup__input" type="password" maxlength="20" minlength="8" data-input-move name="password" value="25022003r">
                        <p class="header__input-search-text">Пароль</p>
                        <button class="password-show-hide" type="button">
                            <img class="password-show-hide__img" src="<?=SITE_TEMPLATE_PATH?>/img/svg/eye.svg" alt="eye">
                        </button>
                    </div>
                </div>

                <div class="header__registration-input">
                    <div class="header__input-search input-popup">
                        <input class="header__input-search-input input-popup__input" type="password" maxlength="20" minlength="8" data-input-move name="repeat-password" value="25022003r">
                        <p class="header__input-search-text">Повторите пароль</p>
                        <button class="password-show-hide" type="button">
                            <img class="password-show-hide__img" src="<?=SITE_TEMPLATE_PATH?>/img/svg/eye.svg" alt="eye">
                        </button>
                    </div>
                </div>


                <button id="registration-submit" class="popup-save-btn" type="submit" disabled>
                    Сохранить
                </button>
            </form>
        </div>
    </div>
</div>