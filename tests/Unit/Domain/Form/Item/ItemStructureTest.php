<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Form\Item;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class ItemStructureTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_structure(): void
    {
        $itemStructure = (new ItemStructureBuilder())->withoutComponents()->build();

        self::assertEmpty($itemStructure->getComponents());
    }

    /**
     * @test
     */
    public function it_creates_structure(): void
    {
        $itemStructure = (new ItemStructureBuilder())->withName('structure')->build();

        self::assertSame('structure', $itemStructure->getName());
    }
}
