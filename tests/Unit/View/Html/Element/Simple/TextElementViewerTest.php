<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Element\Simple;

use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use PHPUnit\Framework\TestCase;

final class TextElementViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('');

        self::assertSame('<input type="text">', $html);
    }
}
