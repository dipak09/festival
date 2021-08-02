# Festival Project
Project run with Laravel 8. Data in a particular manner: We display the band record label with filter and sorting, in this project we need to update composer and run projects in php 7.4 version only

## Preprocess
install [Npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm), [PHP-7.4](https://computingforgeeks.com/how-to-install-php-on-ubuntu), [Composer](https://getcomposer.org), [Git](https://git-scm.com/)

## Getting started
``` bash
# Clone repository 
# Goto repository directory
# Follow 2-3 steps

# install dependencies
composer install # to get php library and dependency 
npm install # for get node packages

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate  # for generate laravel Unique key
 
```
Then launch the server:
``` bash
php artisan serve
```

The Laravel sample task is now up and running! Access it at http://localhost:8000

To show Festival sample task result at http://localhost:8000/get-festival