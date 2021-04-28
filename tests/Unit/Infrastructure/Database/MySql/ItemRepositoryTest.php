<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database\MySql;

use EasyAdmin\Application\Logger\Logger;
use EasyAdmin\Domain\Database\Exception\EntityNotFoundException;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Component\TextComponentBuilder;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;
use Tests\Doubles\Stub\StubConnector;

final class ItemRepositoryTest extends TestCase
{
    private ItemStructure $structure;

    /**
     * @test
     */
    public function it_creates_an_item_with_null_value(): void
    {
        $textElement = (new TextElementBuilder())->withValue('')->build();
        $this->structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->addComponent((new TextComponentBuilder())->withTextElement($textElement)->build())
            ->build();

        self::assertTrue($this->getRepository()->create($this->structure));
    }

    /**
     * @test
     */
    public function it_creates_an_item_without_values(): void
    {
        self::assertTrue($this->getRepository()->create($this->structure));
    }

    /**
     * @test
     */
    public function it_fails_retrieving_values_when_item_not_find(): void
    {
        self::expectException(EntityNotFoundException::class);
        $this->getRepository()->get($this->structure, 1);
    }

    /**
     * @test
     */
    public function it_removes_an_item(): void
    {
        self::assertTrue($this->getRepository()->remove($this->structure));
    }

    /**
     * @test
     */
    public function it_updates_an_item(): void
    {
        self::assertTrue($this->getRepository()->update($this->structure));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->build();
    }

    private function getRepository(): ItemRepository
    {
        return new ItemRepository(new StubConnector(), new Logger());
    }
}
