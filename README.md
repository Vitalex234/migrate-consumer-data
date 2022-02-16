<strong>Тестовое задание.</strong>

Описание задания находится в storage/app/Test Middle.docx

При выполнении использованы следующие библиотеки:
- maatwebsite/excel (импорт csv, экспорт xlsx)
- laravel-validation-rules/country-codes (валидация кода страны)

Набор данных для проверки:
- storage/app/random.csv
- storage/app/random2.csv

<strong>Как запустить:</strong>

Скачиваем проект с репозитория:
git clone https://github.com/Vitalex234/migrate-consumer-data.git

Устанавливаем composer
sudo apt install composer

Скачиваем зависимости (требуется php не ниже 8.0)
composer install

Копируем файл с настройками проекта:
cp .env.example .env

Запускаем laravel sail:
./vendor/bin/sail up -d

Генерируем ключ приложения:
./vendor/bin/sail artisan key:generate

Выполняем миграции:
./vendor/bin/sail artisan migrate

Выполняем консольную утилиту:
./vendor/bin/sail artisan import:customers random.csv

Посмотреть результат в бд можно через консольный доступ:
./vendor/bin/sail artisan db
SELECT * FROM customers;

Появился файл со списком ошибок:
storage/app/failures.xlsx

Для проверки запускаем второй набор данных (повторяющиеся по email записи обновляются):
./vendor/bin/sail artisan import:customers random2.csv






