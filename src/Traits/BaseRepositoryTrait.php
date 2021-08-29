<?php

namespace JetBox\Repositories\Traits;


use JetBox\Repositories\Exceptions\RepositoryException;


trait BaseRepositoryTrait
{
    /**
     * Sortable Trait
     */
    use SortableTrait;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    private function baseUpdate(array $attributes, int $id)
    {
        return $this->find($id)->fill($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    private function baseUpdateForce(array $attributes, int $id)
    {
        return $this->find($id)->forceFill($attributes);
    }

    /**
     * @return mixed
     */
    private function baseOrderBy()
    {
        if ($this->orderByDirection === 'desc') {
            return $this->model->latest($this->orderByColumn);
        }

        if ($this->orderByDirection === 'asc') {
            return $this->model->oldest($this->orderByColumn);
        }

        throw RepositoryException::orderByDirection($this);
    }
}
