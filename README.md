# Laravel Repository

![Laravel Repository - Social Image](https://banners.beyondco.de/Laravel%20Repository.png?theme=light&packageManager=composer+require&packageName=jetbox%2Flaravel-repository&pattern=architect&style=style_1&description=Laravel+Repository+Package&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

Laravel Version Support

- > `^5.5` `^6.0` `^7.0` `^8.0`

Php Version Support

- > `^7.0` `^8.0`

[![Latest Stable Version](https://poser.pugx.org/jetbox/laravel-repository/v)](//packagist.org/packages/jetbox/laravel-repository)
[![Total Downloads](https://poser.pugx.org/jetbox/laravel-repository/downloads)](//packagist.org/packages/jetbox/laravel-repository)
[![Latest Unstable Version](https://poser.pugx.org/jetbox/laravel-repository/v/unstable)](//packagist.org/packages/jetbox/laravel-repository)
[![License](https://poser.pugx.org/jetbox/laravel-repository/license)](//packagist.org/packages/jetbox/laravel-repository)

[![Daily Downloads](https://poser.pugx.org/jetbox/laravel-repository/d/daily)](//packagist.org/packages/jetbox/laravel-repository)
[![Monthly Downloads](https://poser.pugx.org/jetbox/laravel-repository/d/monthly)](//packagist.org/packages/jetbox/laravel-repository)
[![Total Downloads](https://poser.pugx.org/jetbox/laravel-repository/downloads)](//packagist.org/packages/jetbox/laravel-repository)

[![Issues](https://img.shields.io/github/issues/DavitMnacakanyan/laravel-repository)](https://github.com/DavitMnacakanyan/laravel-repository/issues)
[![Stars](https://img.shields.io/github/stars/DavitMnacakanyan/laravel-repository)](https://github.com/DavitMnacakanyan/laravel-repository/stargazers)
[![Forks](https://img.shields.io/github/forks/DavitMnacakanyan/laravel-repository)](https://github.com/DavitMnacakanyan/laravel-repository/network/members)

## Table of Contents

- <a href="#installation">Installation</a>
    - <a href="#composer">Composer</a>
    - <a href="#command">Command</a>
- <a href="#methods">Methods</a>
- <a href="#usage">Usage</a>
    - <a href="#create-a-repository">Create a Repository</a>
    - <a href="#use-methods">Use methods</a>

## Installation

### Composer

Execute the following command to get the latest version of the package:

```terminal
composer require jetbox/laravel-repository
```

### Repository Install

```terminal
php artisan repository:install
```

### Create Repository

Create a new Eloquent model repository class

```terminal
php artisan make:repository UserRepository
```

## Methods

### JetBox\Repositories\Contracts\RepositoryInterface

- get($columns = ['*'], $take = false, $pagination = false, $where = false);
- all($columns = ['*']);
- take($take, $columns = ['*']);
- paginate($perPage = false, $columns = ['*']);
- withPaginate($relations, $columns = ['*'], $paginate = 15);
- simplePaginate($perPage = false, $columns = ['*']);
- limit($take, $columns = ['*']);
- find($id, $columns = ['*']);
- findMany($ids, $columns = ['*']);
- findOrFail($id, $columns = ['*']);
- first($columns = ['*']);
- firstOrFail($columns = ['*']);
- where($column, $value = null, $columns = ['*']);
- whereOrFail($column, $value = null, $columns = ['*']);
- whereAll($column, $value = null, $columns = ['*']);
- whereWithAll($column, $value = null, $relations, $columns = ['*']);
- whereBetween($column, $value = [], $columns = ['*']);
- with($relations, $columns = ['*']);
- withCount($relations, $columns = ['*']);
- pluck($column, $key = null);
- create(array $attributes);
- forceCreate(array $attributes);
- update(array $attributes, $model, bool $tap = false, bool $forceFill = false);
- updateForce(array $attributes, $model, bool $tap = false);
- delete($model, bool $tap = false, bool $forceDelete = false);
- forceDelete($model, bool $tap = false);
- querySortable(string $orderByColumn, string $orderByDirection)

## Helpers

- lLog(string $message, string $log = 'info', array $context = [], string $disk = null)
- is_json(string $str, bool $returnData = false)
- currentUser(): ?Authenticatable
- numberFormatShort($n, int $precision = 2)

## EnvironmentTrait
```php 
use JetBox\Repositories\Traits\EnvironmentTrait
```
- changeEnvironmentVariable(string $key, $value): void
- environmentVariableAllUpdate(array $data): void

## File Facade
- JetBoxFile::save(string $path, object $file, string $fileName = null, array $options = [])
- JetBoxFile::delete(Model $model, string $field, string $path)
- JetBoxFile::numberFormatSizeUnits(int $sizeInBytes)

## Constants
- AppConstants::permissions(): array
- AppConstants::roles(): array
- AppConstants::status(): array
```php
namespace App\Constants;

use JetBox\Repositories\Constants\AppConstants as BaseAppConstants;

final class AppConstants extends BaseAppConstants
{
    const ROLE_VISITOR = 'visitor';
    const ROLE_EDITOR = 'editor';

    const PERMISSION_VIEW_BLOG = 'view_blog';
}
```

## Usage

### Create a Repository

> #### Recommended This Shorter
> Laravel `^5.7` `^6.0` `^7.0` `^8.0`
> if your model is not linked to the  repository auto, you can override the `$model` property of your repository

```php
namespace App\Repositories;

class UserRepository extends AbstractRepository
{

}
```

### Or

> Laravel `^5.2` `<=5.6` override the `$model` property

```php
namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
   /**
    * @var string
    */
   protected $model = User::class;

   /**
    * Global OrderBy Column
    * @var string
    */
   public $orderByColumn = 'created_at';

   /**
    * Global OrderBy Direction
    * @var string
    */
   public $orderByDirection = 'desc';
}
```

### Use methods

```php
namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\UserRepository as UserR;

class UserController extends BaseController {

    /**
     * @var $users
     */
    protected $users;

    /**
    * UserController constructor.
    * @param UserR $users
    */
    public function __construct(UserR $users)
    {
        $this->users = $users;
    }

    /**
    * @return Application|Factory|View
    */
    public function index()
    {
        $users = $this->users->all();

        return view('users', compact('users'));
    }

}
```

Find all results in Repository

```php
$users = $this->users->all();
```

Find by result by id

```php
$user = $this->users->find($id);
```
