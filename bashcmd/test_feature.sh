#!/bin/bash

docker-compose exec -T app php artisan optimize:clear && docker-compose exec -T app vendor/bin/phpunit --testdox --testsuite=Feature
