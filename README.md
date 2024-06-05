<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



### DB connection requisites

localhost:9090 (PhpMyAdmin)<br>
DBName: larabase<br>
Username: root<br>
Password: root<br>

### ! Перед началом работы выполнить миграции !
Зайти в папку ./src<br>
в консоли запустить процесс миграции<br>
php artisan migrate<br>
#### Порядок создания аккаунта
php artisan create:tokentype {name}<br>
php artisan create:apiservice {service_name} {tokentype_name}<br>
php artisan create:token {apiservice_name} {tokentype_name} {token_key}<br>
php artisan create:company {company_name}<br>
php artisan create:account {name} {company_name} {tokentype_name}<br>

#### Примеры консольных команд по выгрузке данных 
php artisan import:incomes {account_name}<br>
php artisan import:orders {account_name}    <br>
php artisan import:sales {account_name}    <br>
php artisan import:stocks {account_name}     <br>

#### Порядок запуска овтообновления БД
После запуска контейнера необходимо зайти в него PHP<br>
и прописать команду для интерактивного взаимодействия с ним.<br>
docker exec -it wb-api-php-1 bash <br>
внутри контейнера прописать и запустить<br>
php artisan schedule:run >> /dev/null 2>&1

#### Параметры для файла .env в отношении работы с БД
DB_CONNECTION=mysql<br>
DB_HOST=172.23.0.1<br>
DB_PORT=3307<br>
DB_DATABASE=larabase<br>
DB_USERNAME=root<br>
DB_PASSWORD=root<br>



##### Tables: incomes, orders, stocks, sales.

Примеры запросов на локальной машине:

##### INCOMES
GET http://localhost/api/incomes?dateFrom=2024-04-01&dateTo=2024-05-29&page=1&limit=500

#### STOCKS
(only dateFrom === today-date)<br>
GET http://localhost/api/stocks?dateFrom=2024-05-29&page=1&limit=500

#### SALES
GET http://localhost/api/sales?dateFrom=2024-04-01&dateTo=2024-05-29&page=1&limit=500

#### ORDERS
GET http://localhost/api/orders?dateFrom=2024-04-01&dateTo=2024-05-29&page=1&limit=500



