<?php

declare(strict_types=1);

namespace EasyAdmin\Form\FormType;

use EasyAdmin\Form\Button\Button;
use EasyAdmin\Form\Button\CreateButton;
use EasyAdmin\Form\FormType\Tag\FormTag;
use EasyAdmin\Form\Item\ItemStructure;

final class CreateForm implements Form
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
