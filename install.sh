#!/usr/bin/env bash

docker-compose up --build -d

docker-compose exec php-cli composer install

if [ ! -f ./.env ]; then
    cp ./.env.example ./.env
    docker-compose exec php-cli php artisan key:generate
fi

docker-compose exec php-cli php artisan migrate
docker-compose exec php-cli php artisan db:seed
docker-compose exec php-cli ./vendor/bin/phpunit --coverage-html ./public/coverage/
