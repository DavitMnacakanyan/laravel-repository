# Laravel 6,7,8 Repositories

Laravel Repository Package

[![Latest Stable Version](https://poser.pugx.org/jetbox/laravel-repository/v)](//packagist.org/packages/jetbox/laravel-repository)
[![Total Downloads](https://poser.pugx.org/jetbox/laravel-repository/downloads)](//packagist.org/packages/jetbox/laravel-repository) 
[![Latest Unstable Version](https://poser.pugx.org/jetbox/laravel-repository/v/unstable)](//packagist.org/packages/jetbox/laravel-repository)
[![License](https://poser.pugx.org/jetbox/laravel-repository/license)](//packagist.org/packages/jetbox/laravel-repository)


[![Daily Downloads](https://poser.pugx.org/DavitMnacakanyan/laravel-repository/d/daily)](//packagist.org/packages/jetbox/laravel-repository)
[![Monthly Downloads](https://poser.pugx.org/DavitMnacakanyan/laravel-repository/d/monthly)](//packagist.org/packages/jetbox/laravel-repository)
[![Total Downloads](https://poser.pugx.org/DavitMnacakanyan/laravel-repository/downloads)](//packagist.org/packages/jetbox/laravel-repository)

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
- all($columns = ['*'], $orderBy = 'created_at');
- take($take, $columns = ['*'], $orderBy = 'created_at');
- paginate($perPage = false, $columns = ['*'], $orderBy = 'created_at');
- simplePaginate($perPage = false, $columns = ['*'], $orderBy = 'created_at');
- limit($take, $columns = ['*'], $orderBy = 'created_at');
- find($id, $columns = ['*']);
- first($columns = ['*']);
- where($field, $value, $columns = ['*']);
- whereAll($field, $value, $columns = ['*'], $orderBy = 'created_at');
- whereBetween($field, $value = [], $columns = ['*'], $orderBy = 'created_at');
- with($relation, $columns = ['*'], $orderBy = 'created_at');
- withCount($relation, $columns = ['*'], $orderBy = 'created_at');

## Usage

### Create a Repository

```php
namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
   /**
    * @return mixed|string
    */
   protected function model()
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
