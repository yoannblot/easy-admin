<?php

declare(strict_types=1);

namespace Tests\Unit\Viewer\Html\Element\Simple;

use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use PHPUnit\Framework\TestCase;

final class TextElementViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('', '');

        self::assertSame('<input type="text">', $html);
    }

    /**
     * @test
     */
    public function it_creates_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('John Doe', '');

        self::assertSame('<input type="text" value="John Doe">', $html);
    }

    /**
     * @test
     */
    public function it_creates_text_input_with_name(): void
    {
        $html = (new TextElementViewer())->toHtml('John Doe', 'fullname');

        self::assertSame('<input type="text" name="fullname" id="fullname" value="John Doe">', $html);
    }
}
