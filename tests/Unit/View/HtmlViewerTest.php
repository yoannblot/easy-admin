<?php

declare(strict_types=1);

namespace Tests\Unit\View;

use EasyAdmin\View\Html\Component\Simple\TextHtmlComponentView;
use EasyAdmin\View\Html\Element\Simple\HtmlTextElementView;
use EasyAdmin\View\Html\Label\LabelView;
use EasyAdmin\View\HtmlViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Item\ItemStructureBuilder;

final class HtmlViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_text_component(): void
    {
        $itemStructure = (new ItemStructureBuilder())->build();

        $html = $this->getViewer()->toHtml($itemStructure);
        self::assertSame('<label>label value</label><input type="text">', $html);
    }

    private function getViewer(): HtmlViewer
    {
        return new HtmlViewer(
            [
                new TextHtmlComponentView(
                    new LabelView(),
                    new HtmlTextElementView()
                ),
            ]
        );
    }
}
