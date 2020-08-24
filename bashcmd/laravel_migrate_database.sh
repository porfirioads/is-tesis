#!/bin/bash

docker-compose exec -T app php artisan migrate:fresh --seed
