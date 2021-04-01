<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Form\FormType\Tag\FormTag;
use EasyAdmin\Form\Item\ItemStructure;

final class FormTagFactory
{
    public function getCreateFormTag(ItemStructure $structure): FormTag
    {
        $id = 'create-form-' . $structure->getName();
        $action = 'create/' . $structure->getName();

        return new FormTag($id, $id, 'POST', $action);
    }
}
