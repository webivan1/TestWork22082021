# Little Emperors Test

This test consists on a backend and a frontend part.

The backend should be done in Laravel and committed to the _backend_ folder on this repository.

The frontend should be done with ReactJS and committed to the _frontend_ folder.

On both parts, feel free to install any libraries or plugins you want to facilitate the tasks. Take as much time as you need and commit the code to the repository when you're done. 

## BACKEND
### Test 1
Implement a console command to import a CSV file with a list of hotels and store them in a local database. You can use any database engine of your choice.
In the hotels.csv file there are the fields and data you need to import.
Note the file columns are separated by semicolon ';' as some of the content might have commas in it, like the Hotel Name or the Description.

To help with the CSV parsing, you're free to install via composer any existing import library if you want or just use the PHP CSV functions. The script should run from the console via a simple command.

The script should run using the command: `php artisan import:hotels`

### Test 2
Implement a Restful API to manage CRUD operations for the hotels stored in the database from the *Test 1*.
The API should have an endpoint for each of the following actions:
- Return the list of all hotels. It should display only the id, name and city fields of each hotel.
- Return all the details of a single hotel given its ID.
- Add a new hotel in the database.
- Update the details of a single hotel.
- Delete a single hotel from the database.

## FRONTEND
Using the backend API created in the backend test, build a ReactJS web app to display the list of hotels.
The app should consist of an single listing page displaying the name, image, city and stars for each hotel.
The design is completely up to you but don't worry too much about it, something very simple is fine. Feel free to use for example bootstrap css classes or any design template.

## Install and run

### Backend

- `cd backend && cp .env.example .env`
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


