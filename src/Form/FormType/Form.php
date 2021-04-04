<?php

declare(strict_types=1);

namespace EasyAdmin\Form\FormType;

use EasyAdmin\Form\Button\Button;
use EasyAdmin\Form\FormType\Tag\FormTag;
use EasyAdmin\Form\Item\ItemStructure;

interface Form
{
    public function getTag(): FormTag;

    public function getStructure(): ItemStructure;

    public function getButton(): Button;
}
