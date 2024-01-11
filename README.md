# Laravel 10 with Sail from scratch

## Quick setup

### 0. Prerequisites
Ensure that [PHP Composer](https://getcomposer.org) is installed on your system. If it's not, [install it following these instructions](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-**macos**).

### 1. Creating a Laravel Project

Run the following command to create a new Laravel project in a directory named "laravel-from-scratch". This command sets up a ready-to-use Laravel environment, complete with all necessary configurations and directories.

    composer create-project laravel/laravel laravel-from-scratch



### 2. Installing Docker Using Sail
Laravel Sail provides a lightweight command-line interface for interacting with Laravel's default Docker development environment.

We can select additional services as needed. [Find instructions and details here](https://laravel.com/docs/10.x/#choosing-your-sail-services). If not specified, Laravel will install only the database server and the web server by default.

On Linux (refer to [The Official Guide](https://laravel.com/docs/10.x/#docker-installation-using-sail) for other operating systems) we can use these commands:
    
    composer require laravel/sail --dev
    php artisan sail:install

To start the containers, use:

    ./vendor/bin/sail up

To run Docker in the background, add the -d parameter:

    /vendor/bin/sail up -d

Our Laravel environment is now successfully set up and can be accessed at http://localhost.

Alternatively, you can clone this repository to save some of the work ;)


