<?php

declare(strict_types=1);

namespace Unit\Form\Label;

use EasyAdmin\Form\Label\Label;
use PHPUnit\Framework\TestCase;

final class LabelTest extends TestCase
{
    /**
     * @test
     */
    public function it_keeps_value(): void
    {
        $value = 'this is a label';

        $element = new Label($value);
        self::assertSame($value, $element->getValue());
    }
}
