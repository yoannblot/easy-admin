<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Parser\Xml\Component\Common;

use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\Form\Item\ItemFactory;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Common\ValuesParser;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Component\TextComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;
use Tests\Doubles\Stub\StubItemFactory;
use Tests\Doubles\Stub\StubItemRepository;
use Tests\Doubles\Stub\StubTranslator;

final class ValuesParserTest extends TestCase
{
    private ItemFactory $itemFactory;

    private ItemRepository $itemRepository;

    /**
     * @test
     *
     * @throws
     */
    public function it_parses_from_an_item(): void
    {
        $idComponent = (new IdComponentBuilder())->build();
        $component = (new TextComponentBuilder())->withName('name')->build();
        $itemStructure = (new ItemStructureBuilder())
            ->addComponent($idComponent)
            ->addComponent($component)
            ->build();
        $this->itemFactory->setItemStructure($itemStructure);
        $expectedValues = [
            [
                'number' => 1,
                $component->getBind() => 'mr',
            ],
            [
                'number' => 3,
                $component->getBind() => 'miss',
            ],
        ];
        $this->itemRepository->setExpectedValues($expectedValues);

        $xml = '<select values="item:civility|name|name"/>';
        $values = $this->getParser()->parse('civility', new SimpleXMLElement($xml));
        self::assertSame(
            [
                1 => 'mr',
                3 => 'miss',
            ],
            $values
        );
    }

    /**
     * @test
     *
     * @throws
     */
    public function it_parses_from_simple_list(): void
    {
        $xml = '<select values="mr+ms+miss"/>';
        $values = $this->getParser()->parse('civility', new SimpleXMLElement($xml));
        self::assertSame(
            [
                'mr' => 'civility.mr',
                'ms' => 'civility.ms',
                'miss' => 'civility.miss',
            ],
            $values
        );
    }

    protected function setUp(): void
    {
        $this->itemFactory = new StubItemFactory();
        $this->itemRepository = new StubItemRepository();
    }

    private function getParser(): ValuesParser
    {
        return new ValuesParser(new StubTranslator(), $this->itemFactory, $this->itemRepository);
    }
}
