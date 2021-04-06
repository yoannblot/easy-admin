<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Viewer\Html\Element\Simple;

use EasyAdmin\Infrastructure\Viewer\Html\Element\Simple\TextElementViewer;
use PHPUnit\Framework\TestCase;

final class TextElementViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('', '', false);

        self::assertSame('<input type="text">', $html);
    }

    /**
     * @test
     */
    public function it_creates_empty_required_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('', '', true);

        self::assertSame('<input type="text" required="required">', $html);
    }

    /**
     * @test
     */
    public function it_creates_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('John Doe', '', false);

        self::assertSame('<input type="text" value="John Doe">', $html);
    }

    /**
     * @test
     */
    public function it_creates_text_input_with_name(): void
    {
        $html = (new TextElementViewer())->toHtml('John Doe', 'fullname', false);

        self::assertSame('<input type="text" name="fullname" id="fullname" value="John Doe">', $html);
    }

    /**
     * @test
     */
    public function it_creates_full_text_input(): void
    {
        $html = (new TextElementViewer())->toHtml('John Doe', 'fullname', true);

        self::assertSame(
            '<input type="text" name="fullname" id="fullname" value="John Doe" required="required">',
            $html
        );
    }
}
