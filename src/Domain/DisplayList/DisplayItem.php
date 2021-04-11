<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

final class DisplayItem
{
    /**
     * @var Field[]
     */
    private array $fields;

    private string $updateUrl;

    private string $removeUrl;

    public function __construct(array $fields, string $updateUrl, string $removeUrl)
    {
        $this->fields = $fields;
        $this->updateUrl = $updateUrl;
        $this->removeUrl = $removeUrl;
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
