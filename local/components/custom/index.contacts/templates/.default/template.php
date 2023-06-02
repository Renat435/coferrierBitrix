<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="contacts">
    <div class="container">
        <h3 class="title">
            Контакты
        </h3>

        <form class="contacts__form">
            <div class="contacts__form-item">
                <p class="contacts__form-item-text">Имя</p>
                <input id="contacts-form-name" class="contacts__form-item-input" type="text">
            </div>
            <div class="contacts__form-item">
                <p class="contacts__form-item-text">Email</p>
                <input id="contacts-form-email" class="contacts__form-item-input" type="text">
            </div>
            <div class="contacts__form-item">
                <p class="contacts__form-item-text">Сообщение</p>
                <textarea id="contacts-form-message" class="contacts__form-item-input contacts__form-item-input--textarea"
                          maxlength="300"></textarea>
            </div>

            <button id="contacts-send-btn" class="contacts__form-button" type="button">
                    <span class="contacts__form-button-text">
                        Отправить
                    </span>
            </button>

        </form>
    </div>
</section>