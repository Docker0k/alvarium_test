#!/usr/bin/env bash

sleep 2
composer install --no-progress --prefer-dist --working-dir=/app

php artisan key:generate
php artisan storage:link

php artisan migrate
php artisan migrate --env=testing


exec php-fpm --nodaemonize
