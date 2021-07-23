### Create env

- `cd backend && cp .env.example .env`
  
### Install

- `docker-compose run --rm hotels-php-cli composer install`

### Run server

- `docker-compose up --build -d`
  
### Settings

- `docker-compose run --rm hotels-php-cli php artisan key:generate`
- `docker-compose run --rm hotels-php-cli php artisan storage:link`
- `docker-compose run --rm hotels-php-cli php artisan migrate`
- `docker-compose run --rm hotels-php-cli php artisan import:hotels`

### Linter

- `docker-compose run --rm hotels-php-cli composer phpcs`
- `docker-compose run --rm hotels-php-cli composer phpcbf` - Fix code style

### Tests

- `docker-compose run --rm hotels-php-cli composer test`
