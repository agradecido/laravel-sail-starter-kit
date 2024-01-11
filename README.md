# Laravel 10 with Sail from scratch

## Quick setup

### Prerequisites
Ensure that [PHP Composer](https://getcomposer.org) is installed on your system. If it's not, [install it following these instructions](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-**macos**).

### Creating a Laravel Project

Run the following command to create a new Laravel project in a directory named "laravel-from-scratch". This command sets up a ready-to-use Laravel environment, complete with all necessary configurations and directories.

    composer create-project laravel/laravel laravel-from-scratch



### Installing Docker Using Sail
Laravel Sail provides a lightweight command-line interface for interacting with Laravel's default Docker development environment.

We can select additional services as needed. [Find instructions and details here](https://laravel.com/docs/10.x/#choosing-your-sail-services). If not specified, Laravel will install only the database server and the web server by default.

On Linux we can use these commands (refer to [The Official Guide](https://laravel.com/docs/10.x/#docker-installation-using-sail) for other operating systems) :
    
    composer require laravel/sail --dev
    ./vendor/bin/sail artisan

It is advisable to create an alias like this to facilitate the execution of commands with sail:
    
    alias sail='bash vendor/bin/sail'

### Database Connection

First, copy the `.env.example` file to a new `.env` file. This can be done with the following command:

    cp .env.example .env

Next, open the `.env` file and update the database connection settings. Here's an example of what these settings might look like:

```env
DB_CONNECTION=localhost
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
``````

Remember to replace the values with your actual database information. The `DB_HOST` should be set to the name of your Sail Docker container for MySQL (which is `mysql` by default).

After setting up the `.env` file, you should run the following command to generate a new application key:

    ./vendor/bin/sail artisan key:generate

Finally, you can start the Laravel Sail environment with the following command:

    ./vendor/bin/sail up

Our Laravel environment is now successfully set up and can be accessed at http://localhost.

Alternatively, you can clone this repository to save some of the work ;)

### Databases and Migrations
Laravel's powerful database migration feature allows you to define and manage your database schema easily. Migrations are like version control for your database, allowing your team to modify and share the application's database schema.

To run your database migrations using Laravel Sail, execute the following command:
    
    ./vendor/bin/sail php artisan migrate

Remember to create migration files for your database tables before running this command. You can create a new migration using the command:

    ./vendor/bin/sail php artisan make:migration create_your_table_name_table

#### Note: Document Under Development

This document is currently under development and will be updated with more information and guidance as the project evolves. 
