# ApartemenKu BACKEND

## Setup

### Install dependecies

```php
composer install
```

### Setup Env

1. copy env

```
cp .env.example .env
```

2. setup .env

```env
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=semesta-hackathon
DB_USERNAME=postgres
DB_PASSWORD=
```

### Migration + seeder

```sh
php artisan migrate --seed
```

### Create JWT Secret

```sh
php artisan jwt:secret
```

### Link Storage

```
php artisan storage:link
```

### Run Backend

```
php artisan serve
```
