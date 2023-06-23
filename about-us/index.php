<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О нас");
?>

    <section class="about-us">
        <div class="container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__item-link" href="/">Главная</a>
                </li>
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__item-link" href="/about-us">О нас</a>
                </li>
            </ul>
            <h3 class="page-title">
                О нас
            </h3>

            <div class="about-us__info">
                <img class="about-us__info-img left" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-3.jpg" alt="картинка-1">
                <div class="about-us__info-content right">
                    <span>
                        Coferrier - это ваше место, где кофе становится настоящим искусством. Мы предлагаем уникальную платформу, где вы можете сделать заказ, отслеживать его статус и наслаждаться богатым выбором напитков. Наши кафе - это оазисы, где профессиональные бариста создают неповторимые вкусы. Мы постоянно работаем над обновлением каталога, чтобы удовлетворить самые изысканные вкусы наших клиентов.
                    </span>
                </div>
            </div>
            <div class="about-us__info">
                <div class="about-us__info-content left">
                    <span>
                        В Coferrier мы также любим радовать вас новыми акциями и специальными предложениями. Будьте в курсе последних новостей, чтобы не упустить возможность попробовать новые напитки или получить особые бонусы. Мы стремимся сделать ваше кофеенное путешествие незабываемым, и ваше удовлетворение - наша главная цель. Присоединяйтесь к нам сегодня и окунитесь в мир вкуса и удовольствия с Coferrier.
                    </span>
                </div>
                <img class="about-us__info-img right" src="<?= SITE_TEMPLATE_PATH ?>/img/gallery-4.jpg"
                     alt="картинка-1">
            </div>
            <div class="about-us__social">
                <span class="about-us__social-title">Мы здесь</span>
                <a class="about-us__social-href" href="https://youtube.com">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/youtube.svg" alt="youtube">
                </a>
                <a class="about-us__social-href" href="https://vk.com">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/vk.svg" alt="vk">
                </a>
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>