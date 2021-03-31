<?php

declare(strict_types=1);

namespace Tests\Unit\Form\Element\Simple;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;

final class TextElementTest extends TestCase
{
    /**
     * @test
     */
    public function it_keeps_value(): void
    {
        $value = 'this is a value';

        $element = (new TextElementBuilder())->withValue($value)->build();
        self::assertSame($value, $element->getValue());
    }
}
