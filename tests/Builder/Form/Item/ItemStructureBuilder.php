<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Item;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Item\ItemStructure;
use Tests\Builder\Form\Label\LabelBuilder;

final class ItemStructureBuilder
{
    private string $name;

    private array $components;

    public function __construct()
    {
        $this->name = 'structure';
        $this->components = [
            new TextComponent((new LabelBuilder())->build(), new TextElement('value')),
        ];
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

    public function build(): ItemStructure
    {
        return new ItemStructure($this->name, $this->components);
    }
}
