<?php


namespace JetBox\Repositories\Eloquent;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Query\Expression;
use JetBox\Repositories\Contracts\RepositoryInterface;
use JetBox\Repositories\Traits\BaseRepositoryTrait as BaseRepository;


abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Trait
     */
    use BaseRepository {
        baseOrderBy as private orderBy;
        baseFindModel as private findModel;
    }

    /**
     * @var bool
     */
    public $model = false;

    /**
     * AbstractRepository constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @return string
     */
    abstract protected function model(): string;

    /**
     * @return AbstractRepository
     * @throws BindingResolutionException
     */
    public function makeModel(): AbstractRepository
    {
        $model = app()->make($this->model());

        $this->model = $model;

        return $this;
    }

    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param false $where
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, $where = false)
    {
        $builder = $this->orderBy();

        if ($take) {
            $builder->take($take);
        }

        if ($pagination) {
            return $builder->paginate($pagination);
        }

        if ($where) {
            $builder->where($where[0], $where[1]);
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
     * @param \Closure|string|array|Expression $column
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
     * @param \Closure|string|array|Expression $column
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
     * @param \Closure|string|array|Expression $column
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
     * @param null $value
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function whereWithAll($column, $value = null, $relations, $columns = ['*'])
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
}
