<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\FormType\Tag;

use EasyAdmin\Domain\Form\FormType\Tag\FormTag;

final class FormTagViewer
{
    public function startTagToHtml(FormTag $formTag): string
    {
        return sprintf(
            '<form id="%s" name="%s" action="%s" method="%s">',
            $formTag->getId(),
            $formTag->getName(),
            $formTag->getAction(),
            $formTag->getMethod()
        );
    }

    public function endTagToHtml(): string
    {
        return '</form>';
    }
}
