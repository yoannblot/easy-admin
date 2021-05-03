<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Viewer\Html\Element\Simple;

use EasyAdmin\Infrastructure\Viewer\Html\Element\Simple\SelectElementViewer;
use PHPUnit\Framework\TestCase;

final class SelectElementViewerTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_empty_select(): void
    {
        $html = (new SelectElementViewer())->toHtml('', '', 'dropdown', false, false);

        self::assertSame('<select name="dropdown" id="dropdown" data-values=""></select>', $html);
    }

    /**
     * @test
     */
    public function it_creates_required_select(): void
    {
        $html = (new SelectElementViewer())->toHtml('', '', 'dropdown', true, false);

        self::assertSame('<select name="dropdown" id="dropdown" required="required" data-values=""></select>', $html);
    }

    /**
     * @test
     */
    public function it_creates_select_with_an_empty_value(): void
    {
        $html = (new SelectElementViewer())->toHtml('value1', '', 'dropdown', false, true);

        self::assertSame(
            '<select name="dropdown" id="dropdown" data-selected-value="value1" data-values=""><option value=""></option></select>',
            $html
        );
    }

    /**
     * @test
     */
    public function it_creates_select_with_an_empty_value_selected(): void
    {
        $html = (new SelectElementViewer())->toHtml('', '', 'dropdown', false, true);

        self::assertSame(
            '<select name="dropdown" id="dropdown" data-values=""><option value="" selected="selected"></option></select>',
            $html
        );
    }

    /**
     * @test
     */
    public function it_creates_select_with_values(): void
    {
        $html = (new SelectElementViewer())->toHtml('', 'item:fake|value', 'dropdown', false, false);

        self::assertSame('<select name="dropdown" id="dropdown" data-values="item%3Afake%7Cvalue"></select>', $html);
    }
}
