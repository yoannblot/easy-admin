<?php

declare(strict_types=1);

namespace Tests\Unit\Viewer\Html\FormType\Tag;

use EasyAdmin\Viewer\Html\FormType\Tag\FormTagViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\FormType\Tag\FormTagBuilder;

final class FormTagViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_html_start_tag(): void
    {
        $tag = (new FormTagBuilder())->build();

        $html = (new FormTagViewer())->startTagToHtml($tag);
        self::assertStringContainsString('<form', $html);
        self::assertStringContainsString("id=\"{$tag->getId()}\"", $html);
        self::assertStringContainsString("name=\"{$tag->getName()}\"", $html);
        self::assertStringContainsString("method=\"{$tag->getMethod()}\"", $html);
        self::assertStringContainsString("action=\"{$tag->getAction()}\"", $html);
    }

    /**
     * @test
     */
    public function it_creates_html_end_tag(): void
    {
        self::assertSame('</form>', (new FormTagViewer())->endTagToHtml());
    }
}
