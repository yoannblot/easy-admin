<?php

declare(strict_types=1);

namespace Tests\Unit\Viewer;

use EasyAdmin\Viewer\Html\Component\ComponentTagViewer;
use EasyAdmin\Viewer\Html\Component\Simple\TextComponentViewer;
use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use EasyAdmin\Viewer\Html\Label\LabelViewer;
use EasyAdmin\Viewer\HtmlViewer;
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
        self::assertSame('<div class="form-item text"><label>label value</label><input type="text" value="text value"></div>', $html);
    }

    private function getViewer(): HtmlViewer
    {
        return new HtmlViewer(
            [
                new TextComponentViewer(
                    new ComponentTagViewer(),
                    new LabelViewer(),
                    new TextElementViewer()
                ),
            ]
        );
    }
}
