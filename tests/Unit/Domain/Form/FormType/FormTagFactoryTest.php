<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Form\FormType;

use EasyAdmin\Domain\Form\FormType\FormTagFactory;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class FormTagFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_a_create_form_tag(): void
    {
        $formTag = $this->getFactory()->getCreateFormTag((new ItemStructureBuilder())->build());
        self::assertSame('POST', $formTag->getMethod());
        self::assertSame('?type=structure&page=create', $formTag->getAction());
        self::assertSame('create-form-structure', $formTag->getId());
        self::assertSame('create-form-structure', $formTag->getName());
    }

    /**
     * @test
     */
    public function it_retrieves_a_remove_form_tag(): void
    {
        $structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->build();
        $formTag = $this->getFactory()->getRemoveFormTag($structure);
        self::assertSame('POST', $formTag->getMethod());
        self::assertSame('?type=structure&page=remove&id=1', $formTag->getAction());
        self::assertSame('remove-form-structure', $formTag->getId());
        self::assertSame('remove-form-structure', $formTag->getName());
    }

    /**
     * @test
     */
    public function it_retrieves_an_update_form_tag(): void
    {
        $structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->build();
        $formTag = $this->getFactory()->getUpdateFormTag($structure);
        self::assertSame('POST', $formTag->getMethod());
        self::assertSame('?type=structure&page=update&id=1', $formTag->getAction());
        self::assertSame('update-form-structure', $formTag->getId());
        self::assertSame('update-form-structure', $formTag->getName());
    }

    private function getFactory(): FormTagFactory
    {
        return new FormTagFactory();
    }
}
