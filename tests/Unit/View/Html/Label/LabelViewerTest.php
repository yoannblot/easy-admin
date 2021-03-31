<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Label;

use EasyAdmin\Viewer\Html\Label\LabelViewer;
use PHPUnit\Framework\TestCase;

final class LabelViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_html_label(): void
    {
        $html = (new LabelViewer())->toHtml('firstname');

        self::assertSame('<label>firstname</label>', $html);
    }
}
