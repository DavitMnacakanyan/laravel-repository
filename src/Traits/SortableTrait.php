<?php

namespace JetBox\Repositories\Traits;

trait SortableTrait
{
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
     * @param string $orderByColumn
     * @param string $orderByDirection
     */
    public function querySortable(string $orderByColumn, string $orderByDirection): void
    {
        $this->orderByColumn = $orderByColumn;
        $this->orderByDirection = $orderByDirection;
    }
}
