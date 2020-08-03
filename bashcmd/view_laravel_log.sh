#!/bin/bash

docker-compose exec app tail -f -n 100 /var/www/storage/logs/laravel.log
