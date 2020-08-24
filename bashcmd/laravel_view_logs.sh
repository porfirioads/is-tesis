#!/bin/bash

docker-compose exec -T app tail -f -n 100 /var/www/storage/logs/laravel.log
