<?php

namespace JetBox\Repositories\Traits;

trait SortableTrait
{
    /**
     * Global OrderBy Direction
     * @var string
     */
    protected $orderByDirection = 'desc';

    /**
     * Global OrderBy Column
     * @var string
     */
    protected $orderByColumn = 'created_at';

    /**
     * @param string $column
     * @param string $direction
     */
    public function querySortable(string $column, string $direction)
    {
        $this->orderByDirection = $direction;
        $this->orderByColumn = $column;
    }
}
