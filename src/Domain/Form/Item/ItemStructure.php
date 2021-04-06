<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Item;

use EasyAdmin\Domain\Form\Component\Component;

final class ItemStructure
{
    private string $name;

    /**
     * @var Component[]
     */
    private array $components;

    /**
     * @param string      $name
     * @param Component[] $components
     */
    public function __construct(string $name, array $components)
    {
        $this->name = $name;
        $this->components = $components;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    public function getTable(): string
    {
        // TODO
        return 'contact';
    }
}
