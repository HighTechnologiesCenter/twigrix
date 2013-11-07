<?php
class TwigTemplateEngine
{
    /**
     * Окружение twig
     *
     * @var Twig_Environment
     */
    private static $twigEnvironment;

    public static function initialize($templateRootPath, $cacheStoragePath)
    {
        Twig_Autoloader::register();

        $debugModeOptionValue = COption::GetOptionString("twigintegration", "debug_mode");
        $debugMode = ($debugModeOptionValue == "Y") ? true : false;

        $loader = new Twig_Loader_Filesystem($templateRootPath);
        self::$twigEnvironment = new Twig_Environment($loader, array(
            'autoescape' => false,
            'cache'      => $cacheStoragePath,
            'debug'      => $debugMode
        ));

        self::addExtensions();

        global $arCustomTemplateEngines;
        $arCustomTemplateEngines["twig"] = array(
            "templateExt" => array("twig"),
            "function"    => "renderTwigTemplate"
        );
    }


    /**
     * Добавляет расширения, в том числе расширение для битрикса, в котором добавляются нужные глобальные переменные и т.п.
     */
    private static function addExtensions()
    {
        self::$twigEnvironment->addExtension(new Twig_Extension_Debug());
        self::$twigEnvironment->addExtension(new BitrixTwigExtension());
    }

    /**
     * Выполняет рендеринг шаблона
     *
     * @param string $templateFile
     * @param array $context
     * @return string
     */
    public static function renderTemplate($templateFile, array $context)
    {
        return self::$twigEnvironment->render($templateFile, $context);
    }

    /**
     * Очистка кеша шаблонов
     */
    public static function clearCacheFiles()
    {
        self::$twigEnvironment->clearCacheFiles();
    }
}

function renderTwigTemplate($templateFile, $arResult, $arParams, $arLangMessages, $templateFolder, $parentTemplateFolder, $template)
{
    echo TwigTemplateEngine::renderTemplate($templateFile, array(
        'params' => $arParams,
        'result' => $arResult,
        'langMessages' => $arLangMessages,
        'template' => $template,
        'templateFolder' => $templateFolder,
        'parentTemplateFolder' => $parentTemplateFolder,
    ));
}