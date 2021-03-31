<?php

declare(strict_types=1);

namespace Tests\Unit\Form\Item;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Item\ItemStructure;
use EasyAdmin\Form\Label\Label;
use PHPUnit\Framework\TestCase;

final class ItemStructureTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_structure(): void
    {
        $itemStructure = new ItemStructure('empty', []);

        self::assertEmpty($itemStructure->getComponents());
    }

    /**
     * @test
     */
    public function it_creates_structure(): void
    {
        $component = new TextComponent(new Label('label'), new TextElement('value'));

        $itemStructure = new ItemStructure('structure', [$component]);
        self::assertSame('structure', $itemStructure->getName());
        self::assertCount(1, $itemStructure->getComponents());
    }
}
