<?php


namespace JetBox\Repositories\Eloquent;


use JetBox\Repositories\Contracts\RepositoryInterface;


abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var bool
     */
    public $model = false;

    /**
     * AbstractRepository constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract protected function model();

    /**
     * @return $this
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * //$this->model = new $this->model; || return new $this->model
     */
    private function makeModel()
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
     * @param string $orderBy
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, $where = false, $orderBy = 'created_at')
    {
        $builder = $this->model->latest($orderBy);

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
     * @param string $orderBy
     * @return mixed
     */
    public function all($columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->get($columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function take($take, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->take($take)->get($columns);
    }

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function paginate($perPage = false, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->paginate($perPage, $columns);
    }

    /**
     * @param $relation
     * @param string[] $columns
     * @param int $paginate
     * @param string $orderBy
     * @return mixed
     */
    public function withPaginate($relation, $columns = ['*'], $paginate = 15, $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->with($relation)->paginate($paginate);
    }

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function simplePaginate($perPage = false, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->simplePaginate($perPage, $columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function limit($take, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->limit($take)->get($columns);
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
     * @param $field
     * @param $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)->first($columns);
    }

    /**
     * @param $field
     * @param $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)->firstOrFail($columns);
    }

    /**
     * @param $field
     * @param $value
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function whereAll($field, $value, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->where($field, $value)->get($columns);
    }

    /**
     * @param $field
     * @param array $value
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function whereBetween($field, $value = [], $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->whereBetween($field, $value)->get($columns);
    }

    /**
     * @param $relation
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function with($relation, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->with($relation)->get($columns);
    }

    /**
     * @param $relation
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function withCount($relation, $columns = ['*'], $orderBy = 'created_at')
    {
        return $this->model->latest($orderBy)->withCount($relation)->get($columns);
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
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function save(array $attributes, int $id): bool
    {
        return $this->find($id)->save($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}
