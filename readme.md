# Twigrix

Модуль подключения шаблонизатора Twig для Битрикс

## Установка

* Загрузить и установить модуль через Маркетплейс Битрикс. 
* После установки он появится в пункте "установленные решения" - "Подключение шаблонизатора Twig".

Twig поставляется вместе с модулем и находится внутри модуля в папке `vendor/Twig`

## Использование

* В init.php необходимо подключить модуль с помощью `CModule::IncludeModule("twigintegration");`.
* В настройках модуля (Настройки — Настройки продукта — Настройки модулей — Подключение шаблонизатора Twig) на время разработки удобнее включить режим `debug`. В режиме debug показываются ошибки в шаблонах и доступна функция `dump`.
* Очистить кеш шаблонов можно в настройках модуля (Настройки — Настройки продукта — Настройки модулей — Подключение шаблонизатора Twig).
* Для обработки шаблонизатором Twig шаблон и языковые файлы должны иметь расширение `.twig`.

## Работа с шаблонами

### Переменные Битрикс, передаваемые в Twig-шаблон

* `params` — `$arParams`;
* `result` — `$arResult`;
* `langMessages` — `$arLangMessages`;
* `template` — `$template`;
* `templateFolder` — `$templateFolder`;
* `parentTemplateFolder` — `$parentTemplateFolder`.

### Другие переменные

* `APPLICATION` — `$APPLICATION` (глобальная переменная Битрикс);
* `LANG` — `LANG` (константа Битрикс);
* `POST_FORM_ACTION_URI` — `POST_FORM_ACTION_URI` (константа Битрикс);
* `DEFAULT_TEMPLATE_PATH` — `DEFAULT_TEMPLATE_PATH` (константа, определенная в `classes/general/templating/BitrixTwigExtension.php`);
* `_REQUEST` — `$_REQUEST`;
* `SITE_SERVER_NAME` — `SITE_SERVER_NAME` (глобальная переменная Битрикс).

### Функции Битрикс, доступные в Twig-шаблоне (все функции принимают те же аргументы, что в Битриксе)

* `ShowMessage`;
* `bitrix_sessid_post`;
* `bitrix_sessid_get`;
* `ShowError`;
* `ShowNote`.

### Дополнительные функции

* `IsUserAdmin` (аналогично вызову `$USER->IsAdmin()`);
* `IsUserAuthorized` (аналогично вызову `$USER->IsAuthorized()`).

### Фильтры

* `formatDate` - форматирование даты с помощью функции Битрикс `FormatDateFromDB()`;
* `russianPluralForm` - получение множественной формы слова.  
Пример: `{{ 'товар|товара|товаров'|russianPluralForm(2) }}`