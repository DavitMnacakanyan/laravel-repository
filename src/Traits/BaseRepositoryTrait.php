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
     * @param int|object $model
     * @return mixed
     */
    private function baseFindModel($model)
    {
        if (is_int($model))
            return $this->find($model);

        return $model;
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
