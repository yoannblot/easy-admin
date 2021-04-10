<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Domain\Form\Button\Button;
use EasyAdmin\Domain\Form\Button\CreateButton;
use EasyAdmin\Domain\Form\FormType\Tag\FormTag;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class BasicForm implements Form
{
    private ItemStructure $structure;

    private FormTag $tag;

    private CreateButton $button;

    public function __construct(FormTag $tag, ItemStructure $structure, CreateButton $button)
    {
        $this->tag = $tag;
        $this->structure = $structure;
        $this->button = $button;
    }

    public function getButton(): Button
    {
        return $this->button;
    }

    public function getTag(): FormTag
    {
        return $this->tag;
    }

    public function getStructure(): ItemStructure
    {
        return $this->structure;
    }
}
