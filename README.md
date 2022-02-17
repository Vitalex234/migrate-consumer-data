<strong>Тестовое задание.</strong>

Описание задания находится в storage/app/Test Middle.docx

При выполнении использованы следующие библиотеки:
- maatwebsite/excel (импорт csv, экспорт xlsx)
- laravel-validation-rules/country-codes (валидация кода страны)

Набор данных для проверки:
- storage/app/random.csv
- storage/app/random2.csv

<strong>Как запустить:</strong>

Скачиваем проект с репозитория:<br>
git clone https://github.com/Vitalex234/migrate-consumer-data.git

Устанавливаем composer<br>
sudo apt install composer

Скачиваем зависимости (требуется php не ниже 8.0)<br>
composer install

Копируем файл с настройками проекта:<br>
cp .env.example .env

Запускаем laravel sail:<br>
./vendor/bin/sail up -d

Генерируем ключ приложения:<br>
./vendor/bin/sail artisan key:generate

Выполняем миграции:<br>
./vendor/bin/sail artisan migrate

Выполняем консольную утилиту:<br>
./vendor/bin/sail artisan import:customers random.csv

Посмотреть результат в бд можно через консольный доступ:<br>
./vendor/bin/sail artisan db<br>
SELECT * FROM customers;

Появился файл со списком ошибок:<br>
storage/app/failures.xlsx

Для проверки запускаем второй набор данных (повторяющиеся по email записи обновляются):<br>
./vendor/bin/sail artisan import:customers random2.csv






