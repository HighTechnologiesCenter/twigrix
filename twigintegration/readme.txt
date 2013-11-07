Данный модуль реализует подключение движка шаблонизации Twig

Установка
1) Загрузить модуль через Marketplace
2) В административном разделе сайта зайти в раздел Настройки - Настройки продукта - Модули
3) Установить модуль "Подключение шаблонизатора Twig (twigintegration)". При установке никаких действий не требуется
Twig поставляется вместе с модулем и находится внутри модуля в папке vendor/Twig

Использование
1) В init.php нужно подключить модуль:
CModule::IncludeModule("twigintegration");
2) В настройках модуля (Настройки - Настройки продукта - Настройки модулей - Подключение шаблонизатора Twig) на время разработки удобнее включить режим debug
В режиме debug показываются ошибки в шаблонах и доступна функция dump
3) Очистить кеш шаблонов можно в настройках модуля (Настройки - Настройки продукта - Настройки модулей - Подключение шаблонизатора Twig)
4) Для обработки шаблонизатором twig шаблон и языковые файлы должны иметь расширение twig

Модуль передает в twig:
Переменные доступные в шаблоне битрикса (название переменной в twig - эта переменная в битриксе):
1) params - $arParams
2) result - $arResult
3) langMessages - $arLangMessages
4) template - $template
5) templateFolder - $templateFolder
6) parentTemplateFolder - $parentTemplateFolder

Другие переменные
1) APPLICATION - $APPLICATION (глобальная переменная битрикса)
2) LANG - LANG (константа битрикса)
3) POST_FORM_ACTION_URI - POST_FORM_ACTION_URI (константа битрикса)
4) DEFAULT_TEMPLATE_PATH DEFAULT_TEMPLATE_PATH (константа, определенная в classes/general/templating/BitrixTwigExtension.php)
5) _REQUEST => $_REQUEST

Функции из битрикса (все функции принимают те же аргументы что в битриксе)
1) ShowMessage
2) bitrix_sessid_post
3) bitrix_sessid_get
4) ShowError
5) ShowNote

Дополнительные функции
1) IsUserAdmin (аналогично вызову $USER->IsAdmin())
2) IsUserAuthorized (аналогично вызову $USER->IsAuthorized())

Фильтры
1) formatDate - форматирование даты с помощью битриксовой функции FormatDateFromDB
2) russianPluralForm - получение множественной формы слова
пример: {{ 'товар|товара|товаров'|russianPluralForm(2) }}
