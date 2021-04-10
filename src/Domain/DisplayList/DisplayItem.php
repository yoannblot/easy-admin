<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

final class DisplayItem
{
    /**
     * @var Column[]
     */
    private array $columns;

    private string $updateUrl;

    public function __construct(array $columns, string $updateUrl)
    {
        $this->columns = $columns;
        $this->updateUrl = $updateUrl;
    }

    /**
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getUpdateUrl(): string
    {
        return $this->updateUrl;
    }
}
