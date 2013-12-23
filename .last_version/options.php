<?php
CJSCore::Init(array("jquery"));
$moduleId = "htc.twigintegrationmodule";
$right = $APPLICATION->GetGroupRight($moduleId);
if ($right >= "R") {
    IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
    IncludeModuleLangFile(__FILE__);

    $allOptions = array(
        array(
            "debug_mode",
            GetMessage("TWIG_INTEGRATION_OPTIONS_DEBUG_MODE"),
            array("checkbox"),
        ),
        array(
            "cache_storage_path",
            GetMessage("TWIG_INTEGRATION_OPTIONS_CACHE_STORAGE_PATH"),
            array("text"),
        ),
    );

    $tabs = array(
        array(
            "DIV" => "edit1",
            "TAB" => GetMessage("MAIN_TAB_SET"),
            "ICON" => "",
            "TITLE" => GetMessage("MAIN_TAB_TITLE_SET"),
        ),
        array(
            "DIV" => "edit2",
            "TAB" => GetMessage("MAIN_TAB_RIGHTS"),
            "ICON" => "",
            "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS"),
        ),
    );
    $tabControl = new CAdminTabControl("tabControl", $tabs);

    CModule::IncludeModule($moduleId);

    if ($REQUEST_METHOD == "POST" && strlen($Update.$Apply.$RestoreDefaults) > 0 && $right == "W" && check_bitrix_sessid()) {
        if (strlen($RestoreDefaults) > 0) {
            COption::RemoveOption("htc.twigintegrationmodule");
        } else {
            foreach ($allOptions as $option) {
                $name = $option[0];
                $value = trim($_REQUEST[$name]);
                if ($option[2][0] == "checkbox" && $value != "Y") {
                    $value = "N";
                }
                COption::SetOptionString("htc.twigintegrationmodule", $name, $value, $option[1]);
            }
        }

        ob_start();
        $Update = $Update.$Apply;
        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
        ob_end_clean();

        if (strlen($_REQUEST["back_url_settings"]) > 0) {
            if ((strlen($Apply) > 0) || (strlen($RestoreDefaults) > 0)) {
                LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($moduleId)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
            } else {
                LocalRedirect($_REQUEST["back_url_settings"]);
            }
        } else {
            LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($moduleId)."&lang=".urlencode(LANGUAGE_ID)."&".$tabControl->ActiveTabParam());
        }
    }

    ?>
    <form method="post" name="twigintegrationmodule_opt_form"  action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($moduleId)?>&amp;lang=<?=LANGUAGE_ID?>">
        <?php
        $tabControl->Begin();
        $tabControl->BeginNextTab();
        $notes = array();
        foreach ($allOptions as $option):
            $value = COption::GetOptionString("htc.twigintegrationmodule", $option[0]);
            $type = $option[2];
            if (isset($option[3])) {
                $notes[] = $option[3];
            }
            ?>
            <tr>
                <td width="40%" nowrap <?php if ($type[0] == "textarea") echo 'class="adm-detail-valign-top"'?>>
                    <?php if (isset($option[3])):?>
                        <span class="required"><sup><?=count($notes)?></sup></span>
                    <?php endif;?>
                    <label for="<?=htmlspecialcharsbx($option[0])?>"><?=$option[1]?>:</label>
                <td width="60%">
                    <?php if ($type[0] == "checkbox"):?>
                        <input type="checkbox" name="<?=htmlspecialcharsbx($option[0])?>" id="<?=htmlspecialcharsbx($option[0])?>" value="Y"<?php if ($value=="Y") echo" checked";?>>
                    <?php elseif ($type[0] == "text"):?>
                        <input type="text" size="<?=$type[1]?>" maxlength="255" value="<?=htmlspecialcharsbx($value)?>" name="<?=htmlspecialcharsbx($option[0])?>" id="<?=htmlspecialcharsbx($option[0])?>"><?php if ($option[0] == "slow_sql_time") echo GetMessage("PERFMON_OPTIONS_SLOW_SQL_TIME_SEC")?>
                    <?php endif?>
                </td>
            </tr>
        <?endforeach?>



        <tr>
            <td valign="top" width="50%">
                <label for="clear_twig_cache"><?=GetMessage("TWIG_INTEGRATION_CLEAR_CACHE_TITLE")?></label>
            </td>
            <td width="50%">
                <input type="button" value="<?=GetMessage('TWIG_INTEGRATION_CLEAR_CACHE_ACTION');?>" id="clear-twig-cache" />
                <input type="hidden" name="clear_twig_cache" value=""/>
            </td>
        </tr>

        <?php
        $tabControl->BeginNextTab();
        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
        $tabControl->Buttons();
        ?>
        <input <?php if ($right<"W") echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
        <input <?php if ($right<"W") echo "disabled" ?> type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
        <?php if (strlen($_REQUEST["back_url_settings"]) > 0):?>
            <input <?php if ($right<"W") echo "disabled" ?> type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?=htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
            <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
        <?php endif?>
        <input type="submit" name="RestoreDefaults" title="<?=GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="confirm('<?=AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?=GetMessage("MAIN_RESTORE_DEFAULTS")?>">
        <?php
        echo bitrix_sessid_post();
        $tabControl->End();
        ?>
    </form>

    <?php
    if (!empty($notes)) {
        echo BeginNote();
        foreach($notes as $key => $str) {
            echo '<span class="required"><sup>' . ($key + 1) . '</sup></span>' . $str . '<br>';
        }
        echo EndNote();
    }
    ?>
<?php } ?>

<?php
//очистка кеша шаблонов
if($_POST["clear_twig_cache"] === "y") {
    TwigTemplateEngine::clearCacheFiles();
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#clear-twig-cache").click(function(){
            $("input[name='clear_twig_cache']").val("y");
            $("form[name='twigintegrationmodule_opt_form']").submit();
        });
    });
</script>