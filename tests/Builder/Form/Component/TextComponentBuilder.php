<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Component;

use EasyAdmin\Form\Component\Simple\TextComponent;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Label\LabelBuilder;

final class TextComponentBuilder
{
    public function build(): TextComponent
    {
        return new TextComponent((new LabelBuilder())->build(), (new TextElementBuilder())->build());
    }
}
