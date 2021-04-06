<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Domain\Form\Button\Button;
use EasyAdmin\Domain\Form\FormType\Tag\FormTag;
use EasyAdmin\Domain\Form\Item\ItemStructure;

interface Form
{
    public function getTag(): FormTag;

    public function getStructure(): ItemStructure;

    public function getButton(): Button;
}
