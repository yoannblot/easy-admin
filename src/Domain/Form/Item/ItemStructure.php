<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Item;

use EasyAdmin\Domain\Form\Component\Component;

final class ItemStructure
{
    private string $name;

    private string $table;

    /**
     * @var Component[]
     */
    private array $components;

    /**
     * @param string      $name
     * @param string      $table
     * @param Component[] $components
     */
    public function __construct(string $name, string $table, array $components)
    {
        $this->name = $name;
        $this->table = $table;
        $this->components = $components;
    }

    public function getIdField(): string
    {
        // TODO retrieve from configuration
        return 'id';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }
}
