#!/bin/bash
# Переименовываем .env.example в .env
cp ./back/api/src/.env.example ./back/api/src/.env
cp ./back/api_admin/src/.env.example ./back/api_admin/src/.env

# Собираем и запускаем контейнеры
docker-compose up -d --build

# Устанавливаем npm зависимости
npm i --prefix ./front/admin/src
npm i --prefix ./front/public/src
npm i --prefix ./back/sockets/src

# Перезапускаем все контейнеры
docker-compose restart

# Установка composer зависимостей
docker exec laravel.api composer install
docker exec laravel.api.admin composer install

# Генерация ключей Laravel
docker exec laravel.api php artisan key:generate
docker exec laravel.api.admin php artisan key:generate

# Создание базы данных и импорт
# ВАЖНО: Замените путь к файлу sne.sql на актуальный путь к вашему файлу с дампом БД
docker exec db.mysql.main mysql -h localhost -P 9090 -u root -ppassword -e "DROP DATABASE sne;"
docker exec db.mysql.main mysql -h localhost -P 9090 -u root -ppassword -e "CREATE DATABASE IF NOT EXISTS sne;"
docker exec -i db.mysql.main mysql -h localhost -P 9090 -u root -ppassword sne < ./sne.sql


# Создание символической ссылки для хранилища Laravel
docker exec laravel.api php artisan storage:link

echo "Установка завершена!"
