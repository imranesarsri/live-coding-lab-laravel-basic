# Live coding laravel crud basic


## Travail à faire

- Créer le `CRUD` des tâches
- Inclure la `recherche` et `filter` en utilisant `AJAX`
- Ajouter la `pagination`
- Ajouter la base de données incluant la table des projets dans les `seeders`
- `adminLte`

___
## Présentation :
[Présentation Live coding Lab Laravel Basic](https://docs.google.com/presentation/d/176TlPBFBSugG85ieaXXGPzOTf3MoXjWpkF5mYHJykJQ/edit?usp=sharing)
___
## Installation Laravel 

```bash
composer create-project laravel/laravel .
```

[Reference Laravel Installation](https://laravel.com/docs/10.x)
___

## Databases
## 1. Env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab_crud_laravel_basic
DB_USERNAME=root
DB_PASSWORD=solicoders
```

### 2. Migrations

```bash
php artisan make:migration create_projects_table
php artisan make:migration create_tasks_table
```

```php
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('name', 50)->unique();
    $table->text('description')->nullable();
    $table->timestamps();
});
```

```php
Schema::create('tasks', function (Blueprint $table) {
    $table->id();
    $table->string('name', 50)->unique();
    $table->text('description')->nullable();
    $table->unsignedBigInteger('project_id');
    $table->timestamps();
    $table->foreign('project_id')->references('id')->on('projects');
});
```
#### Running Migrations:
```bash
php artisan migrate
```
[Reference Laravel Migrations](https://laravel.com/docs/10.x/migrations#main-content)


### 3. Seeders

```bash
php artisan make:seeder ProjectSeeder
php artisan make:seeder TaskSeeder
```

#### ProjectSeeder file
```php
public function run(): void
{
    Project::create([
        'name' => 'Portfolio',
        'description' => 'Développement d\'un site web mettant en valeur nos compétences.',
    ]);

    Project::create([
        'name' => 'Arbre des compétences',
        'description' => 'Création d\'une application web pour l\'évaluation des compétences.',
    ]);

    Project::create([
        'name' => 'CNMH',
        'description' => 'Création d\'une application web pour la gestion des patients de centre CNMH.',
    ]);
}
```
```php

public function run(): void
    {
        Task::create([
            'name' => 'Design Product Pages',
            'description' => 'Create user-friendly product pages with images and descriptions',
            'project_id' => '1',
        ]);

        Task::create([
            'name' => 'Implement Shopping Cart',
            'description' => 'Develop a functional shopping cart for users to add and manage items',
            'project_id' => '1',
        ]);

    }

```

#### DatabaseSeeder file
```php
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProjectSeeder::class,
        ]);
    }
}
```
#### Running Seeders
```bash
php artisan db:seed

```
[Reference Laravel seeders](https://laravel.com/docs/10.x/seeding#writing-seeders)

___

## Routing

```php

Route::get('/', [TaskController::class, 'index'])->name('index');

Route::get('create', [TaskController::class, 'create'])->name('create');
Route::post('store', [TaskController::class, 'store'])->name('store');

Route::get('{task}/edit', [TaskController::class, 'edit'])->name('edit');
Route::put('{task}/update', [TaskController::class, 'update'])->name('update');


Route::delete('{task}/destroy', [TaskController::class, 'destroy'])->name('destroy');
Route::get('{task}/show',[TaskController::class,'show'])->name('show');

```

[Reference Laravel Routing](https://laravel.com/docs/10.x/routing#main-content)

___
## Models

```bash
php artisan make:model Project -m
php artisan make:model Task -m
```
___



## Controllers
```bash
php artisan make:controller TaskController -r

```
[Reference Laravel Controllers](https://laravel.com/docs/10.x/controllers#main-content)
___

## Views

```bash
php artisan make:view Tasks.index
php artisan make:view Tasks.create
php artisan make:view Tasks.edit

php artisan make:view Layouts.Layout
php artisan make:view Layouts.Footer
php artisan make:view Layouts.Navbar
php artisan make:view Layouts.Sidebar
php artisan make:view Layouts.Error404

```
___

## Request

```bash
php artisan make:request FormTaskRequest
```

### Use AdminLte

You need to add the `adminLte` folders [`disk` and `plugins`] to the `Public` folder

[Reference Laravel views](https://laravel.com/docs/10.x/views#main-content)

___
