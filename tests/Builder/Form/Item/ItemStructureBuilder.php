<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Item;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use Tests\Builder\Form\Component\TextComponentBuilder;

final class ItemStructureBuilder
{
    private string $name;

    private string $table;

    /**
     * @var Component[]
     */
    private array $components;

    public function __construct()
    {
        $this->name = 'structure';
        $this->table = 'table';
        $this->components = [
            (new TextComponentBuilder())->build(),
        ];
    }

    public function addComponent(Component $component): self
    {
        $this->components [] = $component;

        return $this;
    }

    public function build(): ItemStructure
    {
        return new ItemStructure($this->name, $this->table, $this->components);
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withoutComponents(): self
    {
        $this->components = [];

        return $this;
    }
}
