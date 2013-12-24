<?php
//путь вычисл€етс€ относительно папки с модулем htc.twigintegrationmodule
CModule::AddAutoloadClasses(
    'htc.twigintegrationmodule',
    array(
        'TwigTemplateEngine' => 'classes/general/templating/TwigTemplateEngine.php',
        'BitrixTwigExtension' => 'classes/general/templating/BitrixTwigExtension.php',
        'Twig_Autoloader' => 'vendor/Twig/Autoloader.php',
    )
);


// Initialize Twig template engine
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$cacheStoragePathOption = COption::GetOptionString("htc.twigintegrationmodule", "cache_storage_path");

if ($cacheStoragePathOption == "") {
    $cacheStoragePath = $documentRoot . BX_PERSONAL_ROOT . "/cache/twig";
} else {
    $cacheStoragePath = $documentRoot . $cacheStoragePathOption;
}

TwigTemplateEngine::initialize($documentRoot, $cacheStoragePath);