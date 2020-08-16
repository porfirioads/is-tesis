#!/bin/bash

CONTROLLER_NAME="$1"

if [ -z "$CONTROLLER_NAME" ]; then
    echo "Uso: bashcmd/laravel_create_controller.sh ControllerName"
else
    docker-compose exec app php artisan make:controller $CONTROLLER_NAME
fi
