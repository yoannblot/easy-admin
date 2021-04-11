<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

final class DisplayItem
{
    private Filters $filters;

    /**
     * @var Field[]
     */
    private array $fields;

    private string $updateUrl;

    private string $removeUrl;

    public function __construct(Filters $filters, array $fields, string $updateUrl, string $removeUrl)
    {
        $this->filters = $filters;
        $this->fields = $fields;
        $this->updateUrl = $updateUrl;
        $this->removeUrl = $removeUrl;
    }

    public function getFilters(): Filters
    {
        return $this->filters;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getUpdateUrl(): string
    {
        return $this->updateUrl;
    }

    public function getRemoveUrl(): string
    {
        return $this->removeUrl;
    }
}
