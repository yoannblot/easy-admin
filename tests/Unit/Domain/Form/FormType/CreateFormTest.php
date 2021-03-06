<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Form\FormType;

use EasyAdmin\Domain\Form\Button\SimpleButton;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\FormType\FormBuilder;
use Tests\Builder\Form\FormType\Tag\FormTagBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class CreateFormTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_form(): void
    {
        $form = (new FormBuilder())->build();

        self::assertNotSame('', $form->getStructure()->getName());
        self::assertNotSame('', $form->getTag()->getName());
    }

    /**
     * @test
     */
    public function it_keeps_tag(): void
    {
        $tag = (new FormTagBuilder())->build();
        $form = (new FormBuilder())->withTag($tag)->build();

        self::assertSame($tag, $form->getTag());
    }

    /**
     * @test
     */
    public function it_keeps_structure(): void
    {
        $structure = (new ItemStructureBuilder())->build();
        $form = (new FormBuilder())->withStructure($structure)->build();

        self::assertSame($structure, $form->getStructure());
    }

    /**
     * @test
     */
    public function it_contains_a_submit_button(): void
    {
        $structure = (new ItemStructureBuilder())->build();
        $form = (new FormBuilder())->withStructure($structure)->build();

        self::assertInstanceOf(SimpleButton::class, $form->getButton());
    }
}
