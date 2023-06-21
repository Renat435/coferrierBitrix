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


<ul class="breadcrumbs">
    <li class="breadcrumbs__item">
        <a class="breadcrumbs__item-link" href="/">Главная</a>
    </li>
    <li class="breadcrumbs__item">
        <a class="breadcrumbs__item-link" href="/catalog">Каталог</a>
    </li>
</ul>


<h3 class="page-title">
    Каталог
</h3>

<ul class="catalog__list">
    <? foreach ($arResult['SECTIONS'] as $item): ?>
        <li class="catalog__list-item">
            <a class="catalog__list-item-inner" href="<?= $item['SECTION_PAGE_URL'] ?>">
                <img class="catalog__list-item-img" src="<?= $item['PICTURE']['SRC'] ?>"
                     alt="<?= $item['PICTURE']['ALT'] ?>">
                <p class="catalog__list-item-text">
                    <?= $item['NAME'] ?>
                </p>
            </a>
        </li>
    <? endforeach; ?>
</ul>

