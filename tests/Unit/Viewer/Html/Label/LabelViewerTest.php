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
        $html = (new LabelViewer())->toHtml('firstname', '', false);

        self::assertSame('<label>firstname</label>', $html);
    }

    /**
     * @test
     */
    public function it_creates_label_with_for_attribute(): void
    {
        $html = (new LabelViewer())->toHtml('My firstname', 'firstname', false);

        self::assertSame('<label for="firstname">My firstname</label>', $html);
    }

    /**
     * @test
     */
    public function it_creates_with_required_class(): void
    {
        $html = (new LabelViewer())->toHtml('firstname', '', true);

        self::assertSame('<label class="required">firstname</label>', $html);
    }

    /**
     * @test
     */
    public function it_creates_full_configured_label(): void
    {
        $html = (new LabelViewer())->toHtml('My firstname', 'firstname', true);

        self::assertSame('<label for="firstname" class="required">My firstname</label>', $html);
    }
}
