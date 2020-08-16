#!/bin/bash

MIGRATION_NAME="$1"

if [ -z "$MIGRATION_NAME" ]; then
    echo "Uso: bashcmd/laravel_create_migration.sh MigrationName"
else
    docker-compose exec app php artisan make:migration $MIGRATION_NAME
fi
