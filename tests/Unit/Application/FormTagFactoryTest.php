<?php

declare(strict_types=1);

namespace Tests\Unit\Application;

use EasyAdmin\Application\Loader\FormTagFactory;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class FormTagFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_form(): void
    {
        $structure = (new ItemStructureBuilder())->withName('name')->build();

        $formTag = (new FormTagFactory())->getCreateFormTag($structure);
        self::assertSame('POST', $formTag->getMethod());
        self::assertSame('create-form-name', $formTag->getName());
        self::assertSame('create-form-name', $formTag->getId());
        self::assertSame('create/name', $formTag->getAction());
    }
}
