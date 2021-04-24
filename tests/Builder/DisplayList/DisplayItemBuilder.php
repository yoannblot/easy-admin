<?php

declare(strict_types=1);

namespace Tests\Builder\DisplayList;

use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\DisplayList\Field;
use EasyAdmin\Domain\DisplayList\Filters;

final class DisplayItemBuilder
{
    private Filters $filters;

    /**
     * @var Field[]
     */
    private array $fields;

    private string $updateUrl;

    private string $removeUrl;

    public function __construct()
    {
        $this->filters = (new FiltersBuilder())->build();
        $this->fields = [];
        $this->updateUrl = '/update';
        $this->removeUrl = '/remove';
    }

    public function addField(Field $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    public function build(): DisplayItem
    {
        return new DisplayItem($this->filters, $this->fields, $this->updateUrl, $this->removeUrl);
    }

    public function withoutFields(): self
    {
        $this->fields = [];

        return $this;
    }

}
