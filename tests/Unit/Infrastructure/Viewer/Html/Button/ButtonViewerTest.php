<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Viewer\Html\Button;

use EasyAdmin\Infrastructure\Viewer\Html\Button\ButtonViewer;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Button\CreateButtonBuilder;

final class ButtonViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_submit_button(): void
    {
        $button = (new CreateButtonBuilder())->build();

        $html = $this->getViewer()->toHtml($button);

        self::assertStringContainsString('type="submit"', $html);
    }

    /**
     * @test
     */
    public function it_creates_a_submit_button_without_name(): void
    {
        $button = (new CreateButtonBuilder())->withoutName()->build();

        $html = $this->getViewer()->toHtml($button);

        self::assertStringNotContainsString('name=', $html);
    }

    private function getViewer(): ButtonViewer
    {
        return new ButtonViewer();
    }
}
