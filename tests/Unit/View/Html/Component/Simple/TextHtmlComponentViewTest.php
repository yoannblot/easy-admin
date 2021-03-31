<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Component\Simple;

use EasyAdmin\Form\Label\Label;
use EasyAdmin\View\Html\Component\Simple\TextHtmlComponentView;
use EasyAdmin\View\Html\Element\Simple\HtmlTextElementView;
use EasyAdmin\View\Html\Label\LabelView;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;

final class TextHtmlComponentViewTest extends TestCase
{
    /**
     * @test
     */
    public function it_contains_label(): void
    {
        $label = new Label('lastname');
        $component = (new TextComponentBuilder())->withLabel($label)->build();
        $html = (new TextHtmlComponentView(new LabelView(), new HtmlTextElementView()))->toHtml($component);

        self::assertStringContainsString('<label>lastname</label>', $html);
    }
}
