<?php


namespace JetBox\Repositories\Eloquent;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Str;
use JetBox\Repositories\Contracts\RepositoryInterface;
use JetBox\Repositories\Exceptions\RepositoryException;
use Exception;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var callable
     */
    protected static $modelNameResolver;

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
    protected static function getNamespace(): string
    {
        try {
            return app(Application::class)->getNamespace();
        } catch (Exception $exception) {
            return 'App\\';
        }
    }

    /**
     * @return mixed
     */
    public function newModel()
    {
        $model = $this->modelName();

        return new $model;
    }

    /**
     * @return bool|Closure|mixed
     */
    public function modelName()
    {
        $resolver = static::$modelNameResolver ?: function (self $model) {

            $modelBaseName = Str::replaceLast('Repository', '', class_basename($model));

            $appNamespace = static::getNamespace();

            return class_exists($appNamespace.'Models\\'.$modelBaseName)
                   ? $appNamespace.'Models\\'.$modelBaseName
                   : $appNamespace.$modelBaseName;
        };

        return $this->model ?: $resolver($this);
    }

    /**
     * @param callable $resolver
     */
    public static function modelNameResolver(callable $resolver)
    {
        static::$modelNameResolver = $resolver;
    }

    /**
     * @param string $orderByColumn
     * @param string $orderByDirection
     */
    public function querySortable(string $orderByColumn, string $orderByDirection): void
    {
        $this->orderByColumn = $orderByColumn;
        $this->orderByDirection = $orderByDirection;
    }

    /**
     * @return mixed
     * @throws RepositoryException
     */
    private function orderBy()
    {
        if ($this->orderByDirection === 'desc') {
            return $this->newModel()->latest($this->orderByColumn);
        }

        if ($this->orderByDirection === 'asc') {
            return $this->newModel()->oldest($this->orderByColumn);
        }

        throw RepositoryException::orderByDirection($this);
    }

    /**
     * @param int|object $model
     * @return mixed
     */
    private function findModel($model)
    {
        if (is_int($model))
            return $this->find($model);

        return $model;
    }

    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param array $where
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, array $where = [])
    {
        $builder = $this->orderBy();

        if ($take) {
            $builder->take($take);
        }

        if ($pagination) {
            return $builder->paginate($pagination);
        }

        if ($where) {
            $builder->where($where);
        }

        return $builder->get($columns);
    }

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this
            ->orderBy()
            ->get($columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function take($take, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->take($take)
            ->get($columns);
    }

    /**
     * @param false $perPage
     * @param string[] $columns
     * @return mixed
     */
    public function paginate($perPage = false, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->paginate($perPage, $columns);
    }

    /**
     * @param $relations
     * @param string[] $columns
     * @param int $paginate
     * @return mixed
     */
    public function withPaginate($relations, $columns = ['*'], $paginate = 15)
    {
        return $this
            ->orderBy()
            ->with($relations)
            ->paginate($paginate);
    }

    /**
     * @param false $perPage
     * @return mixed
     */
    public function simplePaginate($perPage = false, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->simplePaginate($perPage, $columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function limit($take, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->limit($take)
            ->get($columns);
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $ids
     * @param string[] $columns
     * @return mixed
     */
    public function findMany($ids, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->findMany($ids, $columns);
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function firstOrFail($columns = ['*'])
    {
        return $this->model->firstOrFail($columns);
    }

    /**
     * @param Closure|string|array|Expression $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($column, $value = null, $columns = ['*'])
    {
        return $this
            ->model
            ->where($column, $value)
            ->first($columns);
    }

    /**
     * @param Closure|string|array|Expression $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($column, $value = null, $columns = ['*'])
    {
        return $this
            ->model
            ->where($column, $value)
            ->firstOrFail($columns);
    }

    /**
     * @param Closure|string|array|Expression $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereAll($column, $value = null, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->where($column, $value)
            ->get($columns);
    }

    /**
     * @param $column
     * @param $relations
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereWithAll($column, $relations, $value = null, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->where($column, $value)
            ->with($relations)
            ->get($columns);
    }

    /**
     * @param string|Expression $column
     * @param array $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereBetween($column, $value = [], $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->whereBetween($column, $value)
            ->get($columns);
    }

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function with($relations, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->with($relations)
            ->get($columns);
    }

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function withCount($relations, $columns = ['*'])
    {
        return $this
            ->orderBy()
            ->withCount($relations)
            ->get($columns);
    }

    /**
     * @param $column
     * @param null $key
     * @return mixed|void
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function forceCreate(array $attributes)
    {
        return $this->model->forceCreate($attributes);
    }

    /**
     * @param array $attributes
     * @param int|object $model
     * @param bool $tap
     * @param bool $forceFill
     * @return mixed
     */
    public function update(array $attributes, $model, bool $tap = false, bool $forceFill = false)
    {
        $model = $this->findModel($model);

        if ($tap)
            $model = tap($model);
        if ($forceFill)
            $model->forceFill($attributes);
        else
            $model->fill($attributes);

        return $model->update();
    }

    /**
     * @param array $attributes
     * @param int|object $model
     * @param bool $tap
     * @return mixed
     *
     * forceFill
     */
    public function updateForce(array $attributes, $model, bool $tap = false)
    {
        return $this->update($attributes, $model, $tap, true);
    }

    /**
     * @param int|object $model
     * @param bool $tap
     * @param bool $forceDelete
     * @return mixed
     */
    public function delete($model, bool $tap = false, bool $forceDelete = false)
    {
        $model = $this->findModel($model);

        if ($tap)
            $model = tap($model);
        if ($forceDelete)
            return $model->forceDelete();

        return $model->delete();
    }

    /**
     * @param int|object $model
     * @param bool $tap
     * @return mixed
     */
    public function forceDelete($model, bool $tap = false)
    {
        return $this->delete($model, $tap, true);
    }

    /**
     * @param array $attribute
     * @param bool $tap
     * @return mixed
     */
    public function save(array $attribute = [], bool $tap = false)
    {
        $model = $this->newModel()->fill($attribute);

        if ($tap) $model = tap($model);

        return $model->save();
    }
}
