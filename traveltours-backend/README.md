## Install 

Install vendor:

```bash
composer update
composer install
```

create database `traveltours` in mysql and create file `.env`: 

```bash
cp .env.example .env
```

Edit username and password with your mysql: 

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=traveltours
DB_USERNAME=root
DB_PASSWORD=mysql12345
```

Add schema to database: 

```bash
php artisan migrate
```

Gen key app and jwt: 

```bash
php artisan key:generate
php artisan jwt:secret
```
