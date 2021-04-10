<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Item;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Component\Simple\IdComponent;
use LogicException;

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

    /**
     * @return string
     *
     * @throws LogicException
     */
    public function getIdBind(): string
    {
        return $this->getIdComponent()->getBind();
    }

    /**
     * @return int|null
     *
     * @throws LogicException
     */
    public function getId(): ?int
    {
        return $this->getIdComponent()->getValue();
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

    /**
     * @return IdComponent
     *
     * @throws LogicException
     */
    private function getIdComponent(): IdComponent
    {
        foreach ($this->components as $component) {
            if ($component instanceof IdComponent) {
                return $component;
            }
        }

        throw new LogicException('No id component found');
    }
}
