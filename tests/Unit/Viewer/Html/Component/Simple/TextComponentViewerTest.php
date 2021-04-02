<?php

declare(strict_types=1);

namespace Tests\Unit\Viewer\Html\Component\Simple;

use EasyAdmin\Viewer\Html\Component\Simple\TextComponentViewer;
use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use EasyAdmin\Viewer\Html\Label\LabelViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Label\LabelBuilder;

final class TextComponentViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_contains_label(): void
    {
        $label = (new LabelBuilder())->withValue('lastname')->build();
        $component = (new TextComponentBuilder())->withLabel($label)->build();
        $html = (new TextComponentViewer(new LabelViewer(), new TextElementViewer()))->toHtml($component);

        self::assertStringContainsString('<label>lastname</label>', $html);
    }

    /**
     * @test
     */
    public function it_contains_empty_text_input(): void
    {
        $textElement = (new TextElementBuilder())->withoutValue()->build();
        $component = (new TextComponentBuilder())->withTextElement($textElement)->build();
        $html = (new TextComponentViewer(new LabelViewer(), new TextElementViewer()))->toHtml($component);

        self::assertStringContainsString('<input type="text">', $html);
    }
}
