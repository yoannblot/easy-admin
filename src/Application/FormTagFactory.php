<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Domain\Form\FormType\Tag\FormTag;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class FormTagFactory
{
    public function getCreateFormTag(ItemStructure $structure): FormTag
    {
        $id = 'create-form-' . $structure->getName();
        $action = sprintf('?type=%s&page=%s', $structure->getName(), 'create');

        return new FormTag($id, $id, 'POST', $action);
    }
}
