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

    private string $removeUrl;

    public function __construct(array $columns, string $updateUrl, string $removeUrl)
    {
        $this->columns = $columns;
        $this->updateUrl = $updateUrl;
        $this->removeUrl = $removeUrl;
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

    public function getRemoveUrl(): string
    {
        return $this->removeUrl;
    }

    public function has(string $columnName): bool
    {
        foreach ($this->columns as $column) {
            if ($column->getName() === $columnName) {
                return true;
            }
        }

        return false;
    }
}
