<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Element\Simple\IntegerElement;

final class IdComponent implements Component
{
    private IntegerElement $integerElement;

    public function __construct(IntegerElement $integerElement)
    {
        $this->integerElement = $integerElement;
    }

    public function getName(): string
    {
        return 'id';
    }

    public function getBind(): string
    {
        return $this->integerElement->getBind();
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->integerElement->getValue();
    }
}
