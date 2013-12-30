<?php
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang) - 18);
include(GetLangFileName($strPath2Lang . "/lang/", "/install/index.php"));

class htc_twigintegrationmodule extends CModule
{
    var $MODULE_ID = "htc.twigintegrationmodule";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public function htc_twigintegrationmodule()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = GetMessage("TWIG_INTEGRATION_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("TWIG_INTEGRATION_MODULE_DESC");
        $this->PARTNER_NAME = GetMessage("TWIG_INTEGRATION_MODULE_PARTNER");
        $this->PARTNER_URI = GetMessage("TWIG_INTEGRATION_MODULE_URI");
    }

    public function DoInstall()
    {
        global $APPLICATION;
        RegisterModule("htc.twigintegrationmodule");
        $APPLICATION->IncludeAdminFile(GetMessage("TWIG_INTEGRATION_INSTALL_TITLE"), self::getDocumentRoot() . "/bitrix/modules/twigintegration/install/step.php");
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        UnRegisterModule("htc.twigintegrationmodule");
        $APPLICATION->IncludeAdminFile(GetMessage("TWIG_INTEGRATION_UNINSTALL_TITLE"), self::getDocumentRoot() . "/bitrix/modules/twigintegration/install/unstep.php");
    }

    /**
     * @return string
     */
    public static function getDocumentRoot()
    {
        return @$_SERVER["DOCUMENT_ROOT"];
    }
}
