<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\DisplayList;

use EasyAdmin\Domain\DisplayList\DisplayItemsParser;
use EasyAdmin\Domain\DisplayList\FieldsParser;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToIntegerConvertor;
use LogicException;
use PHPUnit\Framework\TestCase;
use Tests\Builder\DisplayList\DisplayItemBuilder;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class DisplayItemsParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_remove_urls_from_ids(): void
    {
        $idComponent = (new IdComponentBuilder())->build();
        $structure = (new ItemStructureBuilder())->addComponent($idComponent)->build();
        $displayItem = (new DisplayItemBuilder())->build();
        $itemsValues = [
            [
                $idComponent->getBind() => 1,
            ],
            [
                $idComponent->getBind() => 2,
            ],
        ];

        $displayItems = $this->getParser()->parse($structure, $displayItem, $itemsValues);
        self::assertCount(2, $displayItems);
        self::assertStringContainsString('1', $displayItems[0]->getRemoveUrl());
        self::assertStringContainsString('2', $displayItems[1]->getRemoveUrl());
    }

    /**
     * @test
     */
    public function it_creates_update_urls_from_ids(): void
    {
        $idComponent = (new IdComponentBuilder())->build();
        $structure = (new ItemStructureBuilder())->addComponent($idComponent)->build();
        $displayItem = (new DisplayItemBuilder())->build();
        $itemsValues = [
            [
                $idComponent->getBind() => 1,
            ],
            [
                $idComponent->getBind() => 2,
            ],
        ];

        $displayItems = $this->getParser()->parse($structure, $displayItem, $itemsValues);
        self::assertCount(2, $displayItems);
        self::assertStringContainsString('1', $displayItems[0]->getUpdateUrl());
        self::assertStringContainsString('2', $displayItems[1]->getUpdateUrl());
    }

    /**
     * @test
     */
    public function it_fails_without_id_component(): void
    {
        $idComponent = (new IdComponentBuilder())->build();
        $structure = (new ItemStructureBuilder())->addComponent($idComponent)->build();
        $displayItem = (new DisplayItemBuilder())->build();
        $itemsValues = [
            [
                'fake' => 'value',
            ],
        ];

        $this->expectException(LogicException::class);

        $this->getParser()->parse($structure, $displayItem, $itemsValues);
    }

    /**
     * @test
     */
    public function it_keeps_filters_from_display_item(): void
    {
        $idComponent = (new IdComponentBuilder())->build();
        $structure = (new ItemStructureBuilder())->addComponent($idComponent)->build();
        $displayItem = (new DisplayItemBuilder())->build();
        $itemsValues = [
            [
                $idComponent->getBind() => 1,
            ],
        ];

        $displayItems = $this->getParser()->parse($structure, $displayItem, $itemsValues);
        self::assertCount(1, $displayItems);
        self::assertSame($displayItem->getFilters(), $displayItems[0]->getFilters());
    }

    private function getParser(): DisplayItemsParser
    {
        return new DisplayItemsParser(new FieldsParser(), new StringToIntegerConvertor());
    }
}
