<?php

declare(strict_types=1);

namespace EasyAdmin\Form\FormType;

use EasyAdmin\Form\FormType\Tag\FormTag;
use EasyAdmin\Form\Item\ItemStructure;

final class CreateForm implements Form
{
    private ItemStructure $structure;

    private FormTag $tag;

    public function __construct(FormTag $tag, ItemStructure $structure)
    {
        $this->tag = $tag;
        $this->structure = $structure;
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
