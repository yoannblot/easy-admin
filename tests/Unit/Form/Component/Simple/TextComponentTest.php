<?php

declare(strict_types=1);

namespace Tests\Unit\Form\Component\Simple;

use EasyAdmin\Form\Component\Simple\TextComponent;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Label\LabelBuilder;

final class TextComponentTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_component(): void
    {
        $component = new TextComponent((new LabelBuilder())->build(), (new TextElementBuilder())->build());
        self::assertInstanceOf(TextComponent::class, $component);
    }
}
