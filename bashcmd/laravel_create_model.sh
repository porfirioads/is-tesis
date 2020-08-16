#!/bin/bash

MODEL_NAME="$1"

if [ -z "$MODEL_NAME" ]; then
    echo "Uso: bashcmd/laravel_create_model.sh ModelName"
else
    docker-compose exec app php artisan make:model Models/$MODEL_NAME
fi
