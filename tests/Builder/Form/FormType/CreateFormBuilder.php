<?php

declare(strict_types=1);

namespace Tests\Builder\Form\FormType;

use EasyAdmin\Form\Button\CreateButton;
use EasyAdmin\Form\FormType\CreateForm;
use EasyAdmin\Form\FormType\Tag\FormTag;
use EasyAdmin\Form\Item\ItemStructure;
use Tests\Builder\Form\FormType\Tag\FormTagBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class CreateFormBuilder
{
    private FormTag $tag;

    private ItemStructure $structure;

    public function __construct()
    {
        $this->tag = (new FormTagBuilder())->build();
        $this->structure = (new ItemStructureBuilder())->build();
    }

    public function withStructure(ItemStructure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function withTag(FormTag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function build(): CreateForm
    {
        return new CreateForm($this->tag, $this->structure, new CreateButton('create', 'submit'));
    }
}
