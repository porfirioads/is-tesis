#!/bin/bash

docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-html tests/coverage-feature --testsuite=Feature
