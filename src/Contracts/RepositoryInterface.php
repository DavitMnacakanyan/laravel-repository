<?php


namespace JetBox\Repositories\Contracts;



interface RepositoryInterface
{
    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param false $where
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, $where = false);

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
     * @param string[] $columns
     * @return mixed
     */
    public function first($columns = ['*']);

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
}
