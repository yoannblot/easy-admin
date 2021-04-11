<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

final class Filters
{
    private string $order;

    private string $orderDirection;

    private int $size;

    public function __construct(string $order, string $orderDirection, int $size)
    {
        $this->order = $order;
        $this->orderDirection = $orderDirection;
        $this->size = $size;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
