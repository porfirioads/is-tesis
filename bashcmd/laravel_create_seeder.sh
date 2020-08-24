#!/bin/bash

SEEDER_NAME="$1"

if [ -z "$SEEDER_NAME" ]; then
    echo "Uso: bashcmd/laravel_create_seeder.sh SeederName"
else
    docker-compose exec -T app php artisan make:seeder $SEEDER_NAME
fi
