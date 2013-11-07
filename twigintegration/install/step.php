<?if(!check_bitrix_sessid()) return;?>

<?php echo CAdminMessage::ShowNote(GetMessage("TWIG_INTEGRATION_INSTALL_COMPLETED")); ?>

<form action="<?echo $APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?echo LANG?>">
    <input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
<form>