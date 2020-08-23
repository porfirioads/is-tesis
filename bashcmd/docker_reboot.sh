#!/bin/bash

docker-compose down
docker-compose build -q
docker-compose up -d
