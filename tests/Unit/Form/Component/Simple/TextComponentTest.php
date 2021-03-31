<?php

declare(strict_types=1);

namespace Unit\Form\Component\Simple;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;
use PHPUnit\Framework\TestCase;

final class TextComponentTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_component(): void
    {
        $component = new TextComponent(new Label('label'), new TextElement('value'));
        self::assertInstanceOf(TextComponent::class, $component);
    }
}
