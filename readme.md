<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Laravel STOA Schedule Service

## Постановка задачи

Реализовать на Laravel Framework сервис, который хранит и возвращает расписание работы СТОА. 
СТОА - станция технического обслуживания автомобиля.

Функциональность:

* Выгрузка данных о расписаниях работы СТОА из абстрактного провайдера данных (для тестового задания данные передаются как csv файлик)
* Сохранение расписания в бд (структура базы, методы по сохранению)
* Получение расписания о всех СТОА
* Получения расписания о СТОА в заданном временном интервале (интервал передается как аргумент к api методу)


Также реализовать:

* тесты unit/интеграционные c code coverage
* swagger документация к API, которая автоматически собирается
* Dockerfile и docker-compose для запуска проекта

## Запуск проекта

Для запуска необходимо запустить скрипт `./install.sh` или выполнить следующий набор команд самостоятельно:
```
docker-compose up --build -d

docker-compose exec php-cli composer install

if [ ! -f ./.env ]; then
    cp ./.env.example ./.env
    docker-compose exec php-cli php artisan key:generate
fi

docker-compose exec php-cli php artisan migrate
docker-compose exec php-cli php artisan db:seed
docker-compose exec php-cli ./vendor/bin/phpunit --coverage-html ./public/coverage/
```

## Swagger

Документация к API (формируется автоматически из комменатриев phpdocs) Swagger доступна по ссылке: http://localhost:8080/api/documentation 

Чтобы отправить запрос на API нужно пройти авторизацию.

## Авторизация

Для добавления в базу данных тестовых аккаунтов, необходимо использовать команду: `docker-compose exec php-cli php artisan db:seed`

После этого в бд будут созданы пользователи, под которыми можно будет авторизоваться и отправлять запросы через Swagger:

`user1@example.com` / `ap1Tok3n_1`

`user2@example.com` / `ap1Tok3n_2` 

## Тестирование / Запуск тестов

Для запуска тестов необходимо запустить команду: `docker-compose exec php-cli ./vendor/bin/phpunit`

Для определения code coverage запустить команду: `docker-compose exec php-cli ./vendor/bin/phpunit --coverage-html ./public/coverage/` 

Покрытие кода тестами можно увидеть по ссылке: http://localhost:8080/coverage/
Code Coverage Dashboard: http://localhost:8080/coverage/dashboard.html
