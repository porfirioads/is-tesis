#!/bin/bash

# Clean laravel project
docker-compose exec app php artisan optimize:clear

# PHPDoc generation for Laravel Facades
docker-compose exec app php artisan ide-helper:generate

# PHPDocs for models
docker-compose exec app php artisan ide-helper:models

# PhpStorm Meta file
docker-compose exec app php artisan ide-helper:meta
