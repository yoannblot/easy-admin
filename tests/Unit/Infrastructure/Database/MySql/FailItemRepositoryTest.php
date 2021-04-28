<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database\MySql;

use EasyAdmin\Domain\Database\Exception\EntityNotFoundException;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use PHPUnit\Framework\TestCase;
use Tests\Builder\DisplayList\FiltersBuilder;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;
use Tests\Doubles\Stub\FailConnector;
use Tests\Doubles\Stub\NullLogger;

final class FailItemRepositoryTest extends TestCase
{
    private ItemStructure $structure;

    /**
     * @test
     */
    public function it_fails_creating_an_item(): void
    {
        self::assertFalse($this->getRepository()->create($this->structure));
    }

    /**
     * @test
     */
    public function it_fails_removing_an_item(): void
    {
        self::assertFalse($this->getRepository()->remove($this->structure));
    }

    /**
     * @test
     */
    public function it_fails_retrieving_an_item(): void
    {
        $this->expectException(EntityNotFoundException::class);
        $this->getRepository()->get($this->structure, 1);
    }

    /**
     * @test
     */
    public function it_fails_retrieving_values(): void
    {
        self::assertSame([], $this->getRepository()->getItemValues($this->structure, (new FiltersBuilder())->build()));
    }

    /**
     * @test
     */
    public function it_fails_updating_an_item(): void
    {
        self::assertFalse($this->getRepository()->update($this->structure));
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
        return new ItemRepository(new FailConnector(), new NullLogger());
    }
}
