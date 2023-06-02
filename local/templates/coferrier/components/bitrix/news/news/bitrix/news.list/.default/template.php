<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<ul class="news__elements">
<?foreach($arResult["ITEMS"] as $arItem):?>

    <li class="news__elements-item">
        <a class="news__elements-item-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <img class="news__elements-item-img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
        </a>
        <p class="news__elements-item-text">
            <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                <span class="news-fat-text"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
            <?endif?>
            <span class="news-fat-text"><?=$arItem["NAME"]?></span>
            <?=$arItem["PREVIEW_TEXT"]?>
        </p>
    </li>

<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

</ul>
