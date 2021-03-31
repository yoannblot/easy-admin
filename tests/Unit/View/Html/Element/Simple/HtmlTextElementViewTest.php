<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Element\Simple;

use EasyAdmin\View\Html\Element\Simple\HtmlTextElementView;
use PHPUnit\Framework\TestCase;

final class HtmlTextElementViewTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_text_input(): void
    {
        $html = (new HtmlTextElementView())->toHtml('');

        self::assertSame('<input type="text">', $html);
    }
}
