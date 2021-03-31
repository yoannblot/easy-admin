<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Component\Simple;

use EasyAdmin\Form\Label\Label;
use EasyAdmin\Viewer\Html\Component\Simple\TextComponentViewer;
use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use EasyAdmin\Viewer\Html\Label\LabelViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;

final class TextComponentViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_contains_label(): void
    {
        $label = new Label('lastname');
        $component = (new TextComponentBuilder())->withLabel($label)->build();
        $html = (new TextComponentViewer(new LabelViewer(), new TextElementViewer()))->toHtml($component);

        self::assertStringContainsString('<label>lastname</label>', $html);
    }
}
