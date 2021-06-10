<p align="center"><a href="https://sirio.co.id" target="_blank"><img src="![laravel app](public/assets/img/sirio.svg')" width="400"></a></p>

## Installation Steps

Open Terminal and Run

```bash
composer install
```

Copy Paste `.env.example` file and rename to `.env`

Edit value `"DB_DATABASE"` in `.env` file into your database name

Open Terminal and Run

```bash
php artisan key:generate
php artisan migrate
```

## How to Run

Make sure MySql is running in your device
Open Terminal and Run

```bash
php artisan serve
```

Open (http://localhost:8000) or (http://127.0.0.1:8000) in your browser
