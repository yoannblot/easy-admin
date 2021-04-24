<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\DisplayList;

use EasyAdmin\Domain\DisplayList\FieldsParser;
use PHPUnit\Framework\TestCase;
use Tests\Builder\DisplayList\DisplayItemBuilder;
use Tests\Builder\DisplayList\FieldBuilder;
use Tests\Builder\Form\Component\TextComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class FieldsParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_parses_a_text_field(): void
    {
        $field = (new FieldBuilder())->build();
        $component = (new TextComponentBuilder())->withName($field->getName())->build();
        $structure = (new ItemStructureBuilder())->addComponent($component)->build();
        $displayItem = (new DisplayItemBuilder())->addField($field)->build();
        $itemValues = [
            $component->getBind() => 'this is cool',
        ];

        $fields = $this->getParser()->parse($structure, $displayItem, $itemValues);
        self::assertCount(1, $fields);
        self::assertSame($field->getName(), $fields[0]->getName());
        self::assertSame($field->getLabel(), $fields[0]->getLabel());
        self::assertSame('this is cool', $fields[0]->getValue());
    }

    /**
     * @test
     */
    public function it_retrieves_an_empty_array_when_no_fields_provided(): void
    {
        $structure = (new ItemStructureBuilder())->build();
        $displayItem = (new DisplayItemBuilder())->withoutFields()->build();
        self::assertSame([], $this->getParser()->parse($structure, $displayItem, []));
    }

    /**
     * @test
     */
    public function it_works_when_value_not_found(): void
    {
        $field = (new FieldBuilder())->build();
        $component = (new TextComponentBuilder())->withName($field->getName())->build();
        $structure = (new ItemStructureBuilder())->addComponent($component)->build();
        $displayItem = (new DisplayItemBuilder())->addField($field)->build();
        $itemValues = [
            'fake key' => 'this is cool',
        ];

        $fields = $this->getParser()->parse($structure, $displayItem, $itemValues);
        self::assertCount(1, $fields);
        self::assertSame($field->getName(), $fields[0]->getName());
        self::assertSame($field->getLabel(), $fields[0]->getLabel());
        self::assertSame('', $fields[0]->getValue());
    }

    private function getParser(): FieldsParser
    {
        return new FieldsParser();
    }
}
