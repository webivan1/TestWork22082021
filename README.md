## Install and run

### Backend

- `cd backend && cp .env.example .env` and add db configuration bellow
```
DB_CONNECTION=pgsql
DB_HOST=hotels-pgsql
DB_PORT=5432
DB_DATABASE=hotels
DB_USERNAME=user
DB_PASSWORD=secret
```
- `docker-compose run --rm hotels-php-cli composer install`
- `docker-compose run --rm hotels-php-cli php artisan key:generate`
- `docker-compose run --rm hotels-php-cli php artisan storage:link`
- `docker-compose run --rm hotels-php-cli php artisan migrate`
- `docker-compose run --rm hotels-php-cli php artisan import:hotels`

----

- `docker-compose up --build -d` - **Start server**

### Frontend (cd frontend)

- `npm install`
- `cp .env.example .env.local`
- `npm start` - listen http://localhost:3000

### Tests

- `docker-compose run --rm hotels-php-cli composer test`

---- (cd frontend) ----

- `npm run test`

