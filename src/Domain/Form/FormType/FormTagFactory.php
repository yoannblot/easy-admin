<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Domain\Form\FormType\Tag\FormTag;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use Symfony\Component\HttpFoundation\Request;

final class FormTagFactory
{
    public function getCreateFormTag(ItemStructure $structure): FormTag
    {
        $id = 'create-form-' . $structure->getName();
        $action = sprintf('?type=%s&page=%s', $structure->getName(), 'create');

        return new FormTag($id, $id, Request::METHOD_POST, $action);
    }

    public function getUpdateFormTag(ItemStructure $structure): FormTag
    {
        $id = 'update-form-' . $structure->getName();
        $action = sprintf('?type=%s&page=%s&id=%d', $structure->getName(), 'update', $structure->getId());

        return new FormTag($id, $id, Request::METHOD_POST, $action);
    }

    public function getRemoveFormTag(ItemStructure $structure): FormTag
    {
        $id = 'remove-form-' . $structure->getName();
        $action = sprintf('?type=%s&page=%s&id=%d', $structure->getName(), 'remove', $structure->getId());

        return new FormTag($id, $id, Request::METHOD_POST, $action);
    }
}
