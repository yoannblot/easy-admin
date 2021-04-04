<?php

declare(strict_types=1);

namespace Tests\Unit\Viewer\Html\Label;

use EasyAdmin\Viewer\Html\Label\LabelViewer;
use PHPUnit\Framework\TestCase;

final class LabelViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_label(): void
    {
        $html = (new LabelViewer())->toHtml('firstname', '');

        self::assertSame('<label>firstname</label>', $html);
    }

    /**
     * @test
     */
    public function it_creates_label_with_for_attribute(): void
    {
        $html = (new LabelViewer())->toHtml('My firstname', 'firstname');

        self::assertSame('<label for="firstname">My firstname</label>', $html);
    }
}
