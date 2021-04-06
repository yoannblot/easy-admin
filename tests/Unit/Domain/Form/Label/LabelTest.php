<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Form\Label;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Label\LabelBuilder;

final class LabelTest extends TestCase
{
    /**
     * @test
     */
    public function it_keeps_value(): void
    {
        $value = 'this is a label';

        $element = (new LabelBuilder())->withValue($value)->build();
        self::assertSame($value, $element->getValue());
    }
}
