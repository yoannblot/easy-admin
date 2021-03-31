<?php

declare(strict_types=1);

namespace Form\Element\Simple;

use EasyAdmin\Form\Element\Simple\TextElement;
use PHPUnit\Framework\TestCase;

final class TextElementTest extends TestCase
{
    /**
     * @test
     */
    public function it_keeps_value(): void
    {
        $value = 'this is a value';

        $element = new TextElement($value);
        self::assertSame($value, $element->getValue());
    }
}
