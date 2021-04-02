<?php

declare(strict_types=1);

namespace Tests\Builder\Form\FormType\Tag;

use EasyAdmin\Form\FormType\Tag\FormTag;

final class FormTagBuilder
{
    public function build(): FormTag
    {
        return new FormTag('id', 'name', 'POST', 'action');
    }
}
