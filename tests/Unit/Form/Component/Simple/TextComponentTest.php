<?php

declare(strict_types=1);

namespace Tests\Unit\Form\Component\Simple;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;

final class TextComponentTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_component(): void
    {
        $component = (new TextComponentBuilder())->build();

        self::assertNotSame('', $component->getLabel()->getValue());
        self::assertNotSame('', $component->getTextElement()->getValue());
    }
}
