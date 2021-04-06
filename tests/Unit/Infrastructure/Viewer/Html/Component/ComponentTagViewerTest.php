<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Viewer\Html\Component;

use EasyAdmin\Infrastructure\Viewer\Html\Component\ComponentTagViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;
use Tests\Unit\Infrastructure\Viewer\Html\Component\Simple\DummyComponent;

final class ComponentTagViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_dummy_start_tag(): void
    {
        $component = new DummyComponent();
        $html = (new ComponentTagViewer())->startTagToHtml($component);
        self::assertSame('<div class="form-item">', $html);
    }

    /**
     * @test
     */
    public function it_creates_text_component_start_tag(): void
    {
        $component = (new TextComponentBuilder())->build();
        $html = (new ComponentTagViewer())->startTagToHtml($component);
        self::assertSame('<div class="form-item text">', $html);
    }

    /**
     * @test
     */
    public function it_creates_end_tag(): void
    {
        self::assertSame('</div>', (new ComponentTagViewer())->endTagToHtml());
    }
}
