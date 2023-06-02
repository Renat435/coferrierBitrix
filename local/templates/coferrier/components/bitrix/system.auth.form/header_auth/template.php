<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="bx-system-auth-form">

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />

    <div class="header__registration-input">
        <div class="header__input-search input-popup">
            <input class="header__input-search-input input-popup__input sign-in" type="text"
                   maxlength="20" data-input-move name="USER_LOGIN" maxlength="50">
            <p class="header__input-search-text">Email</p>
        </div>
    </div>

	<table width="95%">
<!--		<tr>-->
<!--			<td colspan="2">-->
<!--                --><?//=GetMessage("AUTH_LOGIN")?><!--:<br />-->
<!--                <input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" />-->
<!--			</td>-->
<!--		</tr>-->
		<tr>
			<td colspan="2">
			<?=GetMessage("AUTH_PASSWORD")?>:<br />
			<input type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?endif?>
			</td>
		</tr>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label></td>
		</tr>
<?endif?>


		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>

	</table>
</form>

</div>
