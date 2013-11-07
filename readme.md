Данный модуль реализует подключение движка шаблонизации Twig

**Установка**

- Загрузить модуль через Marketplace
- В административном разделе сайта зайти в раздел Настройки Настройки продукта Модули
- Установить модуль "Подключение шаблонизатора Twig (twigintegration)". При установке никаких действий не требуется
- Twig поставляется вместе с модулем и находится внутри модуля в папке vendor/Twig*

**Использование**

- В init.php нужно подключить модуль `CModule::IncludeModule("twigintegration");`
- В настройках модуля (Настройки - Настройки продукта - Настройки модулей - Подключение шаблонизатора Twig) на время разработки удобнее включить режим debug. В режиме debug показываются ошибки в шаблонах и доступна функция dump
- Очистить кеш шаблонов можно в настройках модуля (Настройки - Настройки продукта - Настройки модулей - Подключение шаблонизатора Twig)
- Для обработки шаблонизатором twig шаблон и языковые файлы должны иметь расширение twig

**Модуль передает в twig**

**Переменные доступные в шаблоне битрикса (название переменной в twig - эта переменная в битриксе)**

- `params` - `$arParams`
- `result` - `$arResult`
- `langMessages` - `$arLangMessages`
- `template` - `$template`
- `templateFolder` - `$templateFolder`
- `parentTemplateFolder` - `$parentTemplateFolder`

**Другие переменные**

- `APPLICATION` - `$APPLICATION` (глобальная переменная битрикса)
- `LANG` - `LANG` (константа битрикса)
- `POST_FORM_ACTION_URI` - `POST_FORM_ACTION_URI` (константа битрикса)
- `DEFAULT_TEMPLATE_PATH` - `DEFAULT_TEMPLATE_PATH` (константа, определенная в classes/general/templating/BitrixTwigExtension.php)
- `_REQUEST` => `$_REQUEST`

**Функции из битрикса (все функции принимают те же аргументы что в битриксе)**

- `ShowMessage`
- `bitrix_sessid_post`
- `bitrix_sessid_get`
- `ShowError`
- `ShowNote`

**Дополнительные функции**

- `IsUserAdmin` (аналогично вызову `$USER->IsAdmin()`)
- `IsUserAuthorized` (аналогично вызову `$USER->IsAuthorized()`)

**Фильтры**

- `formatDate` - форматирование даты с помощью битриксовой функции FormatDateFromDB
- `russianPluralForm` - получение множественной формы слова. Пример: `{{ 'товар|товара|товаров'|russianPluralForm(2) }}`