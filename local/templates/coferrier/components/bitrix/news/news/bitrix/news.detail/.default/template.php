<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="news-detail">
    <div class="container">

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/">Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/news">Новости</a>
            </li>
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__item-link" href="/news"><?= $arResult["NAME"] ?></a>
            </li>
        </ul>

        <div class="news-detail__inner">
            <img class="news-detail__banner" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>">
            <h4 class="news-detail__title">
                <?=$arResult["NAME"]?>
            </h4>

            <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                <span class="news-detail__subtitle"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
            <? endif; ?>

            <p class="news-detail__text">
                <?=$arResult["DETAIL_TEXT"]?>
            </p>
        </div>

    </div>
</section>