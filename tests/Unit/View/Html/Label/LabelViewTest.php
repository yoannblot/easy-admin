<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Label;

use EasyAdmin\View\Html\Label\LabelView;
use PHPUnit\Framework\TestCase;

final class LabelViewTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_html_label(): void
    {
        $html = (new LabelView())->toHtml('firstname');

        self::assertSame('<label>firstname</label>', $html);
    }
}
