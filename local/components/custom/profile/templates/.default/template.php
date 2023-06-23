<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="profile">
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/">Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/profile/">Профиль</a>
            </li>
        </ul>
        <div class="profile__inner">
            <div class="profile__user">
                <div class="profile__user-wrapper">
                    <div class="profile__user-img-wrapper">
                        <img class="profile__user-img" src="<?= $arResult['PROFILE_INFO']['PERSONAL_PHOTO'] ?>"
                             alt="avatar">
                    </div>
                    <div class="profile__user-info">
                        <div class="profile__user-info-line">
                            <p class="profile__user-info-line-title">
                                Имя:
                            </p>
                            <p class="profile__user-info-line-text">
                                <?= $arResult['PROFILE_INFO']['NAME'] ?>
                            </p>
                        </div>
                        <div class="profile__user-info-line">
                            <p class="profile__user-info-line-title">
                                Номер телефона:
                            </p>
                            <p class="profile__user-info-line-text">
                                <?= $arResult['PROFILE_INFO']['PERSONAL_PHONE'] ?>
                            </p>
                        </div>
                        <div class="profile__user-info-line">
                            <p class="profile__user-info-line-title">
                                Логин / email:
                            </p>
                            <p class="profile__user-info-line-text">
                                <?= $arResult['PROFILE_INFO']['LOGIN'] ?>
                            </p>
                        </div>
                        <button class="profile__user-info-btn popup-link" type="button"
                                data-popup-name="change-profile">
                            Изменить
                        </button>
                        <div class="popup change-profile-popup" data-popup-name="change-profile">
                            <div class="popup__inner">
                                <div class="popup__close-area"></div>
                                <form id="change-profile-form" class="popup__body" method="post"
                                      enctype="multipart/form-data">
                                    <label class="change-profile-popup__label">
                                        <input id="profile-change-avatar-input"
                                               class="profile__change-info-input change-profile-popup__input"
                                               type="file"
                                               accept="image/png, image/jpeg, image/gif">
                                        <img id="preview-avatar" class="change-profile-popup__img"
                                             src="<?= $arResult['PROFILE_INFO']['PERSONAL_PHOTO'] ?>" alt="avatar">
                                    </label>
                                    <button class="popup__close-btn" type="button">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/close-btn.svg" alt="close-btn">
                                    </button>
                                    <div class="header__popup-inner">
                                        <div class="header__registration-input">
                                            <div class="header__input-search input-popup">
                                                <input class="profile__change-info-input header__input-search-input input-popup__input"
                                                       type="text" name="name" minlength="2" maxlength="20"
                                                       data-input-move value="<?= $arResult['PROFILE_INFO']['NAME'] ?>">
                                                <p class="header__input-search-text">Имя</p>
                                            </div>
                                        </div>
                                        <div class="header__registration-input">
                                            <div class="header__input-search input-popup">
                                                <input id="profile-change-phone" data-phone-pattern
                                                       class="profile__change-info-input header__input-search-input input-popup__input"
                                                       type="text" name="personal_phone" minlength="2" maxlength="20"
                                                       data-input-move
                                                       value="<?= $arResult['PROFILE_INFO']['PERSONAL_PHONE'] ?>">
                                                <p class="header__input-search-text">Номер телефона</p>
                                            </div>
                                        </div>
                                        <div class="header__registration-input">
                                            <div class="header__input-search input-popup">
                                                <input class="profile__change-info-input header__input-search-input input-popup__input"
                                                       type="email" name="login" minlength="5" maxlength="30"
                                                       data-input-move
                                                       value="<?= $arResult['PROFILE_INFO']['LOGIN'] ?>">
                                                <p class="header__input-search-text">Логин / email</p>
                                            </div>
                                        </div>
                                        <button id="profile-change-btn" class="popup-save-btn" type="submit" disabled>
                                            Сохранить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile__user-bottom">
                    <button id="profile-user-exit" class="profile__user-bottom-btn" type="button">
                        Выйти из аккаунта
                        <svg viewBox="0 0 24 24" xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg">
                                        <g/>
                            <g>
                                <g>
                                    <path d="M21.9,10.6c-0.1-0.1-0.1-0.2-0.2-0.3l-2-2c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l0.3,0.3H16c-0.6,0-1,0.4-1,1s0.4,1,1,1h2.6    l-0.3,0.3c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l2-2c0.1-0.1,0.2-0.2,0.2-0.3C22,11.1,22,10.9,21.9,10.6z    "/>
                                    <path d="M17,14c-0.6,0-1,0.4-1,1v1c0,0.6-0.4,1-1,1h-1V8.4c0-1.3-0.8-2.4-1.9-2.8L10.5,5H15c0.6,0,1,0.4,1,1v1c0,0.6,0.4,1,1,1    s1-0.4,1-1V6c0-1.7-1.3-3-3-3H5c0,0,0,0,0,0C4.9,3,4.8,3,4.7,3.1c0,0,0,0,0,0c-0.1,0-0.2,0.1-0.2,0.1c0,0,0,0,0,0c0,0,0,0-0.1,0.1    C4.3,3.3,4.2,3.4,4.2,3.5c0,0,0,0,0,0.1C4.1,3.6,4,3.7,4,3.8c0,0,0,0,0,0c0,0,0,0,0,0.1C4,3.9,4,4,4,4v14c0,0.4,0.3,0.8,0.6,0.9    l6.6,2.5c0.2,0.1,0.5,0.1,0.7,0.1c0.4,0,0.8-0.1,1.1-0.4c0.5-0.4,0.9-1,0.9-1.6V19h1c1.7,0,3-1.3,3-3v-1C18,14.5,17.6,14,17,14z     M6,17.3V5.4l5.3,2C11.7,7.6,12,8,12,8.4V18c0,0,0,0,0,0l0,1.5L6,17.3z"/>
                                </g>
                            </g>
                                    </svg>
                    </button>

                    <button id="profile-user-change-password" class="profile__user-bottom-btn popup-link"
                            data-popup-name="change-password" type="button">
                        Изменить пароль
                    </button>

                    <div class="popup change-password-popup" data-popup-name="change-password">
                        <div class="popup__inner">
                            <div class="popup__close-area"></div>
                            <div class="popup__body">

                                <h4 class="popup__title">
                                    Изменение пароля
                                </h4>

                                <p class="popup__description">Пароль должен содержать от 8 до 20 символов</p>

                                <button class="popup__close-btn" type="button">
                                    <img src="/local/templates/coferrier/img/svg/close-btn.svg" alt="close-btn">
                                </button>
                                <form id="change-password-form" class="header__popup-inner">

                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input"
                                                   name="current-password" type="password" maxlength="20" minlength="8"
                                                   data-input-move>
                                            <p class="header__input-search-text">Текущий пароль</p>
                                            <button class="password-show-hide" type="button">
                                                <img class="password-show-hide__img"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/img/svg/eye.svg" alt="eye">
                                            </button>
                                        </div>
                                    </div>

                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input"
                                                   name="new-password" type="password" maxlength="20" minlength="8"
                                                   data-input-move>
                                            <p class="header__input-search-text">Новый пароль</p>
                                            <button class="password-show-hide" type="button">
                                                <img class="password-show-hide__img"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/img/svg/eye.svg" alt="eye">
                                            </button>
                                        </div>
                                    </div>

                                    <div class="header__registration-input">
                                        <div class="header__input-search input-popup">
                                            <input class="header__input-search-input input-popup__input"
                                                   name="repeat-new-password" type="password" maxlength="20"
                                                   minlength="8" data-input-move>
                                            <p class="header__input-search-text">Повторите пароль</p>
                                            <button class="password-show-hide" type="button">
                                                <img class="password-show-hide__img"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/img/svg/eye.svg" alt="eye">
                                            </button>
                                        </div>
                                    </div>


                                    <button id="change-user-password" class="popup-save-btn" type="button" disabled>
                                        Изменить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="profile__history">
                <h5 class="profile__history-title">
                    История заказов
                </h5>
                <div class="profile__history-list">

                    <?php foreach ($arResult['ORDERS'] as $item): ?>
                        <div class="profile__history-item">
                            <div class="profile__history-item-top">
                                <div class="profile__history-item-top-images">
                                    <?php if (count($item['ELEMENTS']) === 1): ?>

                                        <img class="profile__history-item-top-image one"
                                             src="<?=$item['ELEMENTS'][0]['PREVIEW_PICTURE']?>" alt="">

                                    <?php else: ?>

                                        <?php foreach ($item['ELEMENTS'] as $key => $picture):?>

                                            <?php if($key < 3):?>
                                                <img class="profile__history-item-top-image"
                                                     src="<?=$picture['PREVIEW_PICTURE']?>"
                                                     alt="">

                                            <?php else:?>

                                                <p class="profile__history-item-top-image">
                                                    +<?=count($item['ELEMENTS']) - 3?>
                                                </p>

                                                <?php break;?>

                                            <?php endif;?>

                                        <?php endforeach;?>

                                    <?php endif; ?>
                                </div>
                                <div class="profile__history-item-top-info">
                                    <p class="profile__history-item-top-info-text"><?= $item['DATE_CREATE'] ?></p>
                                    <p class="profile__history-item-top-info-text"><?= $item['TOTAL_PRICE'] ?>р</p>
                                </div>
                            </div>

                            <p class="profile__history-item-status">
                                Статус заказа:
                                <span class="<?= $item['STATUS_CLASS'] ?>"><?= $item['STATUS'] ?></span>
                            </p>

                            <button class="profile__history-item-more-btn popup-link"
                                    data-popup-name="order-info<?= $item['ID'] ?>"
                                    type="button">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_94_2)">
                                        <path
                                                d="M25.0003 4.16666C13.4899 4.16666 4.16699 13.4896 4.16699 25C4.16699 36.5104 13.4899 45.8333 25.0003 45.8333C36.5107 45.8333 45.8337 36.5104 45.8337 25C45.8337 13.4896 36.5107 4.16666 25.0003 4.16666ZM27.0837 35.4167H22.917V22.9167H27.0837V35.4167ZM27.0837 18.75H22.917V14.5833H27.0837V18.75Z"
                                                fill="#DCC7B8"/>
                                    </g>
                                </svg>
                            </button>

                        </div>

                        <div class="popup" data-popup-name="order-info<?= $item['ID'] ?>">
                            <div class="popup__inner">
                                <div class="popup__close-area"></div>
                                <div class="popup__body">
                                    <p class="profile__history-info-text">
                                        Дата: <?= $item['DATE_CREATE'] ?>
                                    </p>
                                    <p class="profile__history-info-text">
                                        Сумма: <?= $item['TOTAL_PRICE'] ?>р
                                    </p>

                                    <button class="popup__close-btn" type="button">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/close-btn.svg" alt="close">
                                    </button>

                                    <ul class="profile__history-info-list">

                                        <?php foreach ($item['ELEMENTS'] as $element): ?>
                                            <li class="profile__history-info-list-item">
                                                <img class="profile__history-info-list-item-image"
                                                     src="<?= $element['PREVIEW_PICTURE'] ?>"
                                                     alt="">
                                                <p class="profile__history-info-list-item-name">
                                                    <?= $element['NAME'] ?>
                                                </p>

                                                <p class="profile__history-info-list-item-price">
                                                    <?= $element['COUNT'] ?> x <?= $element['PRICE'] ?>р
                                                </p>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>


            </div>
        </div>
    </div>
</section>