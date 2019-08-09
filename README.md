# TestData API

TestData is an application based on PHP Laravel framework for backend and RESTful API. Application consists of people, countries, cities, sports and avatars table, and can be used to create dummy data of people for your own use.

## Supported API routes

People routes:

```
/api/people.list (GET)
/api/person.info (GET)
/api/person.create (POST)
/api/person.update (PATCH)
/api/person.delete (DELETE)
```

Countries routes:

```
/api/countries.list (GET)
```

Cities routes:

```
/api/cities.list (GET)
/api/city.info (GET)
/api/city.create (POST)
/api/city.update (PATCH)
/api/city.delete (DELETE)
```

Sports routes:

```
/api/sports.list (GET)
```

## Configuration


### Step 1: Clone project

```
git clone https://github.com/mvavetic/TestData-API.git
```
### Step 2: ENV

Create env file from env.example:

```
env.example
```

### Step 3: Composer

Run following command in terminal:

```
composer update
```

### Step 4: Key

Run following command in terminal:

```
php artisan key:generate
```

### Step 5: npm

Run following command in terminal:

```
npm install
```

```
npm run development
```

### Step 6: Database

Create database schema `testdata_db`.

Run following commands in terminal to start migrations and seeders:

```
php artisan migrate:fresh
php artisan db:seed
```

### Step 7: Custom commands

Run following commands using Laravel's Artisan to retrieve dummy data for database.

```
php artisan get:countries
```
```
php artisan get:sports
```
```
php artisan get:people
```

## Step 8: Generate Laravel Passport encryption keys

Run following commands in terminal to generate Passport keys:

```
php artisan passport:install
```

### Step 8: Unit Test

Run following commands in terminal to start unit testing:

```
./vendor/bin/phpunit
```

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
