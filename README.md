# PHP-фреймворк. Шаг за шагом

Давайте рассмотрим эволюцию PHP-приложения от "большого комка грязи" до проекта на основе собственного микрофреймворка.
Шаг за шагом обозначим возникающие проблемы и проведем рефакторинг для их устранения. Этот файл является кратким
конспектом этих шагов. Проект является демонстрационным материалом для митапов по PHP-разработке и, в принципе, должен
быть работоспособным.

Каждый шаг рефакторинга - отдельная ветка.

- Запуск локального сервера: php -S localhost:8000
- Проект в браузере: http://localhost:8000

## 000-init-app

Возьмем проект в виде, который типичен для начинающих PHP-разработчиков, в том числе переключившихся с других языков.
Это небольшое приложение - личный микроблог.

- Администратор имеет возможность управлять постами. Файлы, относящиеся к администрированию, находятся в
  директории [admin](admin).
- Реализована аутентификация с помощью сессии. Учетные данные лежат в [конфиге](config.php). Пароль для доступа мы
  храним в открытом виде исключительно для демо-целей (не делайте так!) и трогать его не будем.
- Хранение постов осуществляется в [json-файле](db/posts.json). Доступ к хранилищу даже! инкапусулирован с помощью
  класса [репозитория](classes/PostRepository.php).
- Посетитель может читать посты. Для удобства даже! есть [шаблоны](templates), которые подключаются директивой require к
  каждому PHP-файлу, используемому для вывода.

## 001-public

### Проблема

- Все файлы в публичном доступе. Часто файлы в представленном виде выкладываются на сервер в публичную директорию. В
  этом случае все они находятся в публичном (свободном) доступе через http-запросы.

### Решение

- Создаем директорию для публичного доступа [public](public). Остальной код (хранилище, классы, шаблоны) размещаем вне
  этого каталога. Эмулируем настройку публичной директории, запуская сервер из public.

## 002-render

### Проблема

- Ручное подключение и хардкод параметров шаблонов. Шаблоны внешнего вида подключаются через require с указанием пути и
  расширения файла. При изменениях потребуются правки во всех подключающих файлах.
- Преждевременная отправка заголовков. При выводе контента происходит отправка заголовков ответа, что может приводить к
  проблемам (headers already sent) с сессией, редиректом и т.д.

### Решение

- Пишем [шаблонизатор](classes/View.php) - класс, ответственный за работу с шаблонами внешнего вида.
- Добавляем буферизацию вывода для возможности вернуть сформированный вывод в виде строки.

## 003-data

### Проблема

- Нет возможности работы с динамическими шаблонами. Шаблонизатор способен работать только со статическими шаблонами без
  возможности подстановки данных.
- Смешение кода разметки (HTML) и логики (PHP) в файлах

### Решение

- Добавляем в шаблонизатор возможность передачи данных, необходимых для отрисовки шаблона.
- В PHP-файлах оставляем только логику (PHP-код), весь код разметки (HTML) переносим в [шаблоны](templates).

## 004-autoload

### Проблема

- Ручное подключение классов. В каждом PHP-файле необходимо вручную подключать все необходимые классы с указанием полных
  путей к ним.

### Решение

- Пишем и подключаем простой [загрузчик классов](autoload.php), который в случае необходимости подгружает класс на
  основании его полного имени. Отраслевым стандартом является использование [Composer](https://getcomposer.org/).

## 005-ctrl

### Проблема

- Смешение технического кода (подключение, инициализация и т.д.) и кода, ответственного за обработку запроса.

### Решение

- Выносим обработку запросов из публичной директории в методы классов, называемых [контроллерами](src/App/Controllers).
  Специфичный для приложения код размещаем в отдельной [директории](src/App). Используем пространства имен и импорт
  классов.

## 006-entry

### Проблема

- Множество точек входа в приложение. Каждый публичный файл является точкой входа в приложение, где выполняется
  одинаковый технический код - подключение загрузчика, конфига, старт сессии и прочее.

### Решение

- Приводим приложение к [единой точке входа](public/index.php), которая перенаправляет запрошенное действие нужному
  методу контроллера (роутинг). Используем замыкания для отложенного выполнения кода.

## 007-router

### Проблема

- Смешение кода конфигурации с кодом запуска приложения в index.

### Решение

- Пишем и используем [роутер](src/Router.php) - класс, ответственный за вызов обработчика в зависимости от запроса.
  Конфигурирование роутера осуществляем в отдельном [файле](routes.php). В публичной директории остается универсальный
  код, который можно без изменений использовать в других приложениях.

## 008-container

### Проблема

- Ручная инициализация классов. Все классы необходимо инициализировать руками, с необходимостью иметь заранее
  инициализированные зависимости, которым нужны свои зависимости и так далее. Проблемы при изменении.

### Решение

- Пишем и используем [контейнер](src/Container.php) - класс, ответственный за рекурсивную сборку других классов.
  Конфигурирование зависимостей осуществляем в отдельном [файле](bindings.php).

## 009-config

### Проблема

- Разброс настроек по коду приложения.

### Решение

- Пишем и используем [конфиг](src/Config.php) - класс, ответственный за управление конфигурацией. Конфигурирование
  параметров осуществляем в отдельном [файле](config.php).

## 010-final-app

### Проблема

- Много технического кода в индексном файле.

### Решение

- Пишем и используем [ядро](src/Vendor/Kernel.php) - класс, ответственный за запуск и работу приложения. Перемещаем все
  технические файлы в отдельную [директорию](src/Vendor).

## empty-app

### Проблема

- Необходимость выполнять данные технические шаги с каждым приложением, а не сосредоточиться на разработке программного
  решения.

### Решение

- Чистим приложение от специфического для блога кода. Получаем пустое приложение - микрофреймворк, которое используем
  как стартовое приложение для будущих разработок. Получаем соглашения по структуре файлов, настройке и готовые классы
  для технических задач.

## master

- Дубль ветки empty-app

Спасибо за внимание!

## Лицензия

Этот проект распространяется под [MIT license](https://opensource.org/licenses/MIT).
