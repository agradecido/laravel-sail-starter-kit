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

``````env
DB_CONNECTION=localhost
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
``````

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

    ``````
    sail composer require laravel/sanctum
    ``````

2. Publish Configuration and Migration Files
After installing Sanctum, publish its configuration and migration files to your project. This step copies Sanctum's default configuration and database migration files into your application's directories:

    ``````
    sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    ``````
The configuration file will be placed in your config directory, and the migration files will be added to your database/migrations directory.

1. Run migrations
To create the necessary database tables for Sanctum, run the migrations using:

    ``````
    sail artisan migrate
    ``````

This will apply the new migrations provided by Sanctum, setting up the database structure required for token management.

**Note**: It is possible that Sanctum was already installed in the Laravel distribution. In that case the system will notify you that the tables and the configuration file already exist.

### Next Steps
After installation, you can configure Sanctum as needed for your application by editing the `config/sanctum.php`` file. For more details on configuring and using Sanctum, refer to the official documentation.

## Install Laravel Fortify
As Sanctum only deals with managing cookies and tokens (enough for an API or SPA), we are also going to install Laravel Fortify, which will provide us with the pages and controllers for login, password recovery, email verification, etc.

### Installation Steps 
1. Install Fortify Package
To include Laravel Fortify in your project, run the following command using Laravel Sail. This will download and install the Fortify package:

    ``````
    sail composer require laravel/fortify
    ``````

2. Publish Configuration Files
After installing Fortify, publish its configuration files to your project. This step will copy Fortify's configuration files into your application's config directory:

    ``````
    sail artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
    ``````

3. Run Fortify's Migrations
If your application is going to make use of features such as email verification, you'll need to run the migrations that come with Fortify:

    ``````
    sail artisan migrate
    ``````

4. Configure Fortify
After publishing the configuration files, you will need to configure Fortify according to the needs of your application. This may include setting up the necessary views, defining user authentication states, and more. Detailed instructions can be found in the [official Laravel Fortify documentation](https://laravel.com/docs/10.x/fortify).

5. Update config/auth.php
Ensure that your `config/auth.php` is set up correctly for Fortify, especially the parts related to guards and providers.

### Next Steps
With Fortify installed and configured, your Laravel application now has a robust backend for handling common authentication tasks. Remember to customize and style your authentication views to match the look and feel of your application.

For further customization and to fully leverage Fortify's capabilities, refer to the official documentation and tailor it to fit your application's requirements.

## Install Laravel Breeze
Laravel Breeze incorporates Fortify, providing us with the option to utilize some of the most popular frontend frameworks available today, such as Vue or React.

### Installation Steps
1. Install Breeze
Begin by installing Laravel Breeze into your project using Laravel Sail. This command will download and install Breeze, along with its dependencies:

    ``````
    sail composer require laravel/breeze --dev
    ``````

2. Install Breeze with Blade
Next, install Breeze using the Blade stack. This step will set up Breeze with Blade views and Alpine.js for a minimal yet interactive frontend:

    ``````
    sail artisan breeze:install
    ``````

When prompted, choose "Blade with Alpine" to proceed with a Blade-based frontend.

3. Migrate the Database
Run the migrations to set up the necessary authentication tables in your database:

    ``````
    sail artisan migrate
    ``````

4. Compile Assets
Compile your assets using Laravel Mix. This step is necessary to apply the frontend styles and scripts:

    ``````
    npm install
    npm run dev
    ``````

5. Verify Installation
After installation, navigate to your application's URL. You should now see the new authentication views (like login and register) provided by Breeze.

6. Customization
With Laravel Breeze installed, you can customize the authentication views located in the `resources/views/auth`` directory. Modify these Blade templates to match the look and feel of your application.

For detailed usage and customization instructions, refer to the [Laravel Breeze documentation](https://laravel.com/docs/10.x/starter-kits).

## Document Under Development
This document is currently under development and will be updated with more information and guidance.

