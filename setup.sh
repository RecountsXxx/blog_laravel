cp ./back/api/src/.env.example ./back/api/src/.env
cp ./back/api_admin/src/.env.example ./back/api_admin/src/.env

docker-compose up -d --build

npm i --prefix ./front/admin/src
npm i --prefix ./front/public/src
npm i --prefix ./back/sockets/src

docker exec laravel.api composer install
docker exec laravel.api.admin composer install

docker exec laravel.api php artisan key:generate
docker exec laravel.api.admin php artisan key:generate

docker exec db.mysql.main mysql -h localhost -P 9090 -u root -ppassword -e "DROP DATABASE sne;"
docker exec db.mysql.main mysql -h localhost -P 9090 -u root -ppassword -e "CREATE DATABASE IF NOT EXISTS sne;"
docker exec -i db.mysql.main mysql -h localhost -P 9090 -u root -ppassword sne < ./sne.sql

docker exec laravel.api php artisan storage:link

docker-compose restart

echo "Install his completed!"
