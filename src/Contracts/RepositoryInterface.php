<?php

namespace JetBox\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param array $where
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, array $where = []);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function take($take, $columns = ['*']);

    /**
     * @param false $perPage
     * @param string[] $columns
     * @return mixed
     */
    public function paginate($perPage = false, $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @param int $paginate
     * @return mixed
     */
    public function withPaginate($relations, $columns = ['*'], $paginate = 15);

    /**
     * @param false $perPage
     * @param string[] $columns
     * @return mixed
     */
    public function simplePaginate($perPage = false, $columns = ['*']);

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function limit($take, $columns = ['*']);

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $ids
     * @param string[] $columns
     * @return mixed
     */
    public function findMany($ids, $columns = ['*']);

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function first($columns = ['*']);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function firstOrFail($columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereAll($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param $relations
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereWithAll($column, $relations, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param array $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereBetween($column, $value = [], $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function with($relations, $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function withCount($relations, $columns = ['*']);

    /**
     * @param $column
     * @param null $key
     * @return mixed
     */
    public function pluck($column, $key = null);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function forceCreate(array $attributes);

    /**
     * @param array $attributes
     * @param int|object $model
     * @param bool $tap
     * @param bool $forceFill
     * @return mixed
     */
    public function update(array $attributes, $model, bool $tap = false, bool $forceFill = false);

    /**
     * @param array $attributes
     * @param int|object $model
     * @param bool $tap
     * @return mixed
     */
    public function updateForce(array $attributes, $model, bool $tap = false);

    /**
     * @param int|object $model
     * @param bool $tap
     * @param bool $forceDelete
     * @return mixed
     */
    public function delete($model, bool $tap = false, bool $forceDelete = false);

    /**
     * @param int|object $model
     * @param bool $tap
     * @return mixed
     */
    public function forceDelete($model, bool $tap = false);

    /**
     * @param array $attribute
     * @param bool $tap
     * @return mixed
     */
    public function save(array $attribute = [], bool $tap = false);
}
