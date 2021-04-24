<?php

declare(strict_types=1);

namespace Tests\Builder\DisplayList;

use EasyAdmin\Domain\DisplayList\Filters;

final class FiltersBuilder
{
    private string $order;

    private string $orderDirection;

    private int $size;

    public function __construct()
    {
        $this->order = 'id';
        $this->orderDirection = 'asc';
        $this->size = 10;
    }

    public function build(): Filters
    {
        return new Filters($this->order, $this->orderDirection, $this->size);
    }
}
