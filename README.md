# sail Test

### Installation (With Docker)

## Requirements
1. Docker

```bash

git clone https://github.com/HammudElHammud/royal-test.git
cd royal-test

# To copy .env.example to .env

cp .env.example .env
# To install packages (including sail)
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
    
./vendor/bin/sail up -d
```

Web page can be accessed by `localhost` (`127.0.0.1`). If 80 port is occupied, please change `APP_PORT` to different port number. Then, web page will be `127.0.0.1:<APP_PORT>`

### installation (Without Docker)

## Requirements
1. PHP >= 8.0.2
2. composer

```bash

git clone https://github.com/HammudElHammud/royal-test.git
cd royal-test

# To copy .env.example to .env
cp .env.example .env

composer install
php artisan serve
```

Web page can be accessed by `localhost:8000` (`127.0.0.1:8000`)


> Note: Please make sure `API_BASE_URL=https://symfony-skeleton.q-tests.com` exists inside `.env`

# royal-test
