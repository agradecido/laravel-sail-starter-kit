# Laravel 10 with Sail from scratch



## Quick setup

Alternatively, you can clone this repository to save some of the work ;)

### Prerequisites

Ensure that [PHP Composer](https://getcomposer.org) is installed on your system. If it's not, [install it following these instructions](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-**macos**).

### Creating a Laravel Project

Run the following command to create a new Laravel project in a directory named "laravel-from-scratch". This command sets up a ready-to-use Laravel environment, complete with all necessary configurations and directories.

```shell
composer create-project laravel/laravel laravel-from-scratch
```



### Installing Docker Using Sail

Laravel Sail provides a lightweight command-line interface for interacting with Laravel's default Docker development environment.

We can select additional services as needed. [Find instructions and details here](https://laravel.com/docs/10.x/#choosing-your-sail-services). If not specified, Laravel will install only the database server and the web server by default.

On Linux we can use these commands (refer to [The Official Guide](https://laravel.com/docs/10.x/#docker-installation-using-sail) for other operating systems) :
    
```shell
composer require laravel/sail --dev
./vendor/bin/sail artisan
```

It is advisable to create an alias like this to facilitate the execution of commands with sail:
    
```shell
alias sail='bash vendor/bin/sail'
```



### Database Connection

First, copy the `.env.example` file to a new `.env` file. This can be done with the following command:

```shell
cp .env.example .env
```

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

```shell
sail artisan key:generate
```

Finally, you can start the Laravel Sail environment with the following command:

```shell
sail up
```

Our Laravel environment is now successfully set up and can be accessed at http://localhost.



### Databases and Migrations

Laravel's powerful database migration feature allows you to define and manage your database schema easily. Migrations are like version control for your database, allowing your team to modify and share the application's database schema.

To run your database migrations using Laravel Sail, execute the following command:
    
```shell
sail artisan migrate
```

Remember to create migration files for your database tables before running this command. You can create a new migration using the command:

```shell
sail artisan make:migration create_your_table_name_table
```



## Install Sanctum

Laravel Sanctum provides a lightweight, token-based authentication system for your application. It enables users to generate multiple API tokens for their accounts, each with specific permissions within the application.

### Installation Steps
1. Install Sanctum Package
Use Laravel Sail's command-line interface to require Sanctum into your Laravel project. This command will install the Sanctum package:

    ``````shell
    sail composer require laravel/sanctum
    ``````

2. Publish Configuration and Migration Files
After installing Sanctum, publish its configuration and migration files to your project. This step copies Sanctum's default configuration and database migration files into your application's directories:

    ``````shell
    sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    ``````
The configuration file will be placed in your config directory, and the migration files will be added to your database/migrations directory.

1. Run migrations
   To create the necessary database tables for Sanctum, run the migrations using:

    ``````shell
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

    ``````shell
    sail composer require laravel/fortify
    ``````

2. Publish Configuration Files
After installing Fortify, publish its configuration files to your project. This step will copy Fortify's configuration files into your application's config directory:

    ``````shell
    sail artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
    ``````

3. Run Fortify's Migrations
If your application is going to make use of features such as email verification, you'll need to run the migrations that come with Fortify:

    ``````shell
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

    ``````shell
    sail composer require laravel/breeze --dev
    ``````

2. Install Breeze with Blade
   Next, install Breeze using the Blade stack. This step will set up Breeze with Blade views and Alpine.js for a minimal yet interactive frontend:

    ``````shell
    sail artisan breeze:install
    ``````

When prompted, choose "Blade with Alpine" to proceed with a Blade-based frontend.

3. Migrate the Database
Run the migrations to set up the necessary authentication tables in your database:

    ``````shell
    sail artisan migrate
    ``````

4. Compile Assets
Compile your assets using Laravel Mix. This step is necessary to apply the frontend styles and scripts:

    ``````shell
    npm install
    npm run dev
    ``````

5. Verify Installation
After installation, navigate to your application's URL. You should now see the new authentication views (like login and register) provided by Breeze.

6. Customization
With Laravel Breeze installed, you can customize the authentication views located in the `resources/views/auth`` directory. Modify these Blade templates to match the look and feel of your application.

For detailed usage and customization instructions, refer to the [Laravel Breeze documentation](https://laravel.com/docs/10.x/starter-kits).



## Creación de un CRUD de noticias o posts

Vamos a crear un CRUD de noticias para utilizar en un sitio web como Manerasdevivir.com.

Primero aclaremos las convenciones en cuanto a nombres de Laravel.

#### Aclaraciones sobre la Convención

- **Modelo (Singular)**: `Post` representa un solo registro o entrada en tu base de datos.
- **Tabla (Plural)**: `posts` sería el nombre de la tabla en la base de datos, que Laravel deduce automáticamente a partir del nombre del modelo.
- **Controlador (Plural)**: `PostController` se utiliza para manejar múltiples registros o acciones relacionadas con el modelo `Post`.



Ahora vamos de lleno a crear nuestro CRUD para posts.

### Paso 1: Creación del modelo, migración y controlador

```shell
sail artisan make:model Post -mcr
```

Debemos añadir esto a nuestro modelo Post para luego poder hacer los tests (more information requeried):

```php
class Post extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'author',
        'source',
        'tags',
        'date',
        'time',
        'canonical_url',
        'featured_image',
        'location',
        'published',
    ];

}
```



### Paso 2:  Definir la Estructura de la Tabla

En el archivo de migración generado (ubicado en `database/migrations`), definimos las columnas que necesitamos para el modelo Post:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('author');
            $table->string('source')->nullable();
            $table->string('tags')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('location')->nullable();
            $table->boolean('published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

```



Ahora ejecutamos:

```shell
sail artisan migrate
```



### Paso 3:  Rutas

Definimos las rutas para manejar los posts. Podemos usar rutas de recurso en `routes/web.php`. Esta instrucción crea automáticamente las rutas para todas las acciones CRUD estándar de PostController:

```php
Route::resource('posts', PostController::class);
```



No olvidemos añadir esta línea al principio del fichero para que pueda usar nuestra clase `PostController`:

```php
use App\Http\Controllers\PostController;
```



### Paso 4: Controlador

En `PostController`, implementa los métodos para cada acción CRUD. Laravel ya incluye los métodos básicos en el controlador (index, create, store, show, edit, update, destroy).



### Paso 5: Implementar la Lógica en el Controlador

En PostController, escribiomos la lógica para cada método. Por ejemplo, el método `store` puede lucir así:

```php
public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required',
        'contenido' => 'required',
    ]);

    Noticia::create($request->all());

    return redirect()->route('noticias.index')
                     ->with('success','Noticia creada con éxito.');
}
```

Nos aseguramos de validar los datos antes de crear o actualizar un post. Laravel facilita esto con su sistema de validación.



### Paso 6: Vistas

Creamos las vistas para cada una de estas acciones  (index, create, store, show, edit, update, destroy). En la carpeta resources/views, creamos una nueva

carpeta llamada `posts` y dentro de ella, creamos los archivos Blade para cada acción, como index.blade.php, create.blade.php, edit.blade.php, show.blade.php.

Por ejemplo, en create.blade.php, puedes tener un formulario para crear un nuevo post:

```php+html
<!-- resources/views/noticias/create.blade.php -->
<form method="POST" action="{{ route('noticias.store') }}">
    @csrf
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" required>

    <label for="contenido">Contenido:</label>
    <textarea name="contenido" id="contenido" required></textarea>

    <button type="submit">Crear Noticia</button>
</form>
```

El @csrf es una directiva de Blade en Laravel que genera un campo de token CSRF (Cross-Site Request Forgery) en un formulario HTML. Este token es una medida de seguridad importante para proteger la aplicación web contra ataques CSRF.



## Tests para cada operación CRUD

Vamos a crear tests para nuestro controlador `PostController`. En primer lugar y como ejemplo creemos el test para la función `create`:

```shell
sail artisan make:test CreatePostTest
```

Código del test `tests/Feature/CreatePostTest.php`:

```php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $postData = [
            'title' => 'Test Post',
            'excerpt' => 'This is a test post excerpt.',
            'content' => 'This is the main content of the test post.',
            'author' => $user->name,
            'source' => 'Test Source',
            'tags' => 'test, post',
            'date' => now()->format('Y-m-d'),
            'time' => now()->format('H:i:s'),
            'canonical_url' => 'https://example.com/test-post',
            'featured_image' => 'https://example.com/images/test-post.jpg',
        ];

        $response = $this->actingAs($user)->post('/posts', $postData);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', $postData);
    }
}

```



## Document Under Development

This document is currently under development and will be updated with more information and guidance.

