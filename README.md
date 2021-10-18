# Laravel Repository

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

### Config

Publish Config

```terminal
php artisan vendor:publish --provider="JetBox\Repositories\RepositoryServiceProvider"
```

### Command

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
- getWebsiteName(): string
- getWebsiteUrl(): string

## Usage

### Create a Repository

```php
namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
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

   /**
    * @return string
    */
   protected function model(): string
   {
       return User::class;
   }
}
```

### Use methods

```php
namespace App\Http\Controllers;

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
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
