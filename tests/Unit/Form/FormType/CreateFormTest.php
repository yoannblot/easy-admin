<?php

declare(strict_types=1);

namespace Tests\Unit\Form\FormType;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\FormType\CreateFormBuilder;
use Tests\Builder\Form\FormType\Tag\FormTagBuilder;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class CreateFormTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_form(): void
    {
        $form = (new CreateFormBuilder())->build();

        self::assertNotSame('', $form->getStructure()->getName());
        self::assertNotSame('', $form->getTag()->getName());
    }

    /**
     * @test
     */
    public function it_keeps_tag(): void
    {
        $tag = (new FormTagBuilder())->build();
        $form = (new CreateFormBuilder())->withTag($tag)->build();

        self::assertSame($tag, $form->getTag());
    }

    /**
     * @test
     */
    public function it_keeps_structure(): void
    {
        $structure = (new ItemStructureBuilder())->build();
        $form = (new CreateFormBuilder())->withStructure($structure)->build();

        self::assertSame($structure, $form->getStructure());
    }
}
