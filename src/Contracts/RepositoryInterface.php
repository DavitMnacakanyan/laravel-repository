<?php


namespace JetBox\Repositories\Contracts;



interface RepositoryInterface
{
    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param false $where
     * @param string $orderBy
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, $where = false, $orderBy = 'created_at');

    /**
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function all($columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function take($take, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function paginate($perPage = false, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $relation
     * @param string[] $columns
     * @param int $paginate
     * @param string $orderBy
     * @return mixed
     */
    public function withPaginate($relation, $columns = ['*'], $paginate = 15, $orderBy = 'created_at');

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function simplePaginate($perPage = false, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function limit($take, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

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
     * @param $field
     * @param $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($field, $value, $columns = ['*']);

    /**
     * @param $field
     * @param $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($field, $value, $columns = ['*']);

    /**
     * @param $field
     * @param $value
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function whereAll($field, $value, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $field
     * @param array $value
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function whereBetween($field, $value = [], $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $relation
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function with($relation, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param $relation
     * @param string[] $columns
     * @param string $orderBy
     * @return mixed
     */
    public function withCount($relation, $columns = ['*'], $orderBy = 'created_at');

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): bool;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function save(array $attributes, int $id): bool;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
