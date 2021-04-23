<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Form\FormType;

use EasyAdmin\Domain\Form\Button\SimpleButton;
use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Form\FormType\FormTagFactory;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\IdComponentBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;
use Tests\Doubles\Stub\StubTranslator;

final class FormFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_a_create_form(): void
    {
        $structure = (new ItemStructureBuilder())->build();
        $form = $this->getFactory()->createForm($structure);
        self::assertSame($structure, $form->getStructure());
        self::assertInstanceOf(SimpleButton::class, $form->getButton());
    }

    /**
     * @test
     */
    public function it_retrieves_a_remove_form(): void
    {
        $structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->build();
        $form = $this->getFactory()->removeForm($structure);
        self::assertSame($structure, $form->getStructure());
    }

    /**
     * @test
     */
    public function it_retrieves_an_update_form(): void
    {
        $structure = (new ItemStructureBuilder())
            ->addComponent((new IdComponentBuilder())->build())
            ->build();
        $form = $this->getFactory()->updateForm($structure);
        self::assertSame($structure, $form->getStructure());
    }

    private function getFactory(): FormFactory
    {
        return new FormFactory(new FormTagFactory(), new StubTranslator());
    }
}
