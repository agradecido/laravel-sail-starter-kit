# Laravel 10 with Sail from scratch

## Quick setup
Alternatively, you can clone this repository to save some of the work ;)

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
```

Remember to replace the values with your actual database information. The `DB_HOST` should be set to the name of your Sail Docker container for MySQL (which is `mysql` by default).

After setting up the `.env` file, you should run the following command to generate a new application key:

    sail artisan key:generate

Finally, you can start the Laravel Sail environment with the following command:

    sail up

Our Laravel environment is now successfully set up and can be accessed at http://localhost.

### Databases and Migrations
Laravel's powerful database migration feature allows you to define and manage your database schema easily. Migrations are like version control for your database, allowing your team to modify and share the application's database schema.

To run your database migrations using Laravel Sail, execute the following command:
    
    sail artisan migrate

Remember to create migration files for your database tables before running this command. You can create a new migration using the command:

    sail artisan make:migration create_your_table_name_table

## Install Sanctum
Laravel Sanctum provides a lightweight, token-based authentication system for your application. It enables users to generate multiple API tokens for their accounts, each with specific permissions within the application.

### Installation Steps
1. Install Sanctum Package
Use Laravel Sail's command-line interface to require Sanctum into your Laravel project. This command will install the Sanctum package:

    sail composer require laravel/sanctum

2. Publish Configuration and Migration Files
After installing Sanctum, publish its configuration and migration files to your project. This step copies Sanctum's default configuration and database migration files into your application's directories:

    sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

The configuration file will be placed in your config directory, and the migration files will be added to your database/migrations directory.

1. Run migrations
To create the necessary database tables for Sanctum, run the migrations using:

    sail artisan migrate
    
This will apply the new migrations provided by Sanctum, setting up the database structure required for token management.

### Next Steps
After installation, you can configure Sanctum as needed for your application by editing the config/sanctum.php file. For more details on configuring and using Sanctum, refer to the official documentation.

## Document Under Development
This document is currently under development and will be updated with more information and guidance.

---

Alternatively, you can clone this repository to save some of the work ;)
