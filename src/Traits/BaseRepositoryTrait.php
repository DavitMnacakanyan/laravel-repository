<?php

namespace JetBox\Repositories\Traits;

trait BaseRepositoryTrait
{
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
}
