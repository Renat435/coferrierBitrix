<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="header__list">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
    <li class="header__list-item <?=($arItem["SELECTED"]) ? 'active' : ''?>">
        <a class="header__list-item-link" href="<?=$arItem["LINK"]?>">
            <?=$arItem["TEXT"]?>
        </a>
    </li>
<?endforeach?>

    <li class="header__list-active-bg"></li>

</ul>
<?endif?>