## About Weather App

A very simple weather app that uses a third-party API [OpenWeatherMap](http://openweathermap.org/API), get to fetch weather data by city.

## Installation

For running this app on your local machine you should have following things installed on your machine:

- PHP
- MySQL

Download and extract the project, then follow these steps:

- Create a MySQL database with any name of your choice. (*task_db*, if you don't want to modify `.env` file)
- Modify `.env` file by the name of your database. (skip this step if you named your database *task_db*)
- Run `php artisan storage:link` to create a symlink for public assets.
- Run `php artisan migrate` and `php artisan db:seed` to create database schemas and seed them with data.
- And finally, run `php artisan serve` to run your project.

You can see the app output at **[localhost](http://localhost:8000)**. Additionally you can run
`php artisan test`
to run feature tests.

## Improvement/Suggestion

An option for tracking the current location by IP of the user can be added if a user does not want to type the city name.