#!/bin/sh -e

COMPOSE="docker compose"

if ! $($COMPOSE 2>/dev/null); then
    COMPOSE="docker-compose"
fi

if [ -f ".env" ]; then
    echo ".env fájl már létezik!"
else 
    cp .env.example .env
fi

MODE=dev

$COMPOSE -f docker-compose.yml -f docker-compose.$MODE.yml up -d --build
$COMPOSE exec app composer install
$COMPOSE exec app php artisan key:generate
$COMPOSE exec app php artisan storage:link
$COMPOSE exec app php artisan migrate:fresh --seed
$COMPOSE exec app npm install
$COMPOSE exec app npm run dev
