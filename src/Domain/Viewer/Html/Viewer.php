<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Viewer\Html;

use EasyAdmin\Domain\Form\Item\ItemStructure;

interface Viewer
{
    public function toHtml(ItemStructure $structure): string;
}
