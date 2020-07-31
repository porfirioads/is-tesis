#!/bin/bash

docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-text --testsuite=Unit
