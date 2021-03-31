<?php

declare(strict_types=1);

namespace Tests\Unit\View\Html\Component\Simple;

use EasyAdmin\Form\Label\Label;
use EasyAdmin\View\Html\Component\Simple\TextComponentView;
use EasyAdmin\View\Html\Element\Simple\TextElementView;
use EasyAdmin\View\Html\Label\LabelView;
use PHPUnit\Framework\TestCase;
use Tests\Builder\Form\Component\TextComponentBuilder;

final class TextComponentViewTest extends TestCase
{
    /**
     * @test
     */
    public function it_contains_label(): void
    {
        $label = new Label('lastname');
        $component = (new TextComponentBuilder())->withLabel($label)->build();
        $html = (new TextComponentView(new LabelView(), new TextElementView()))->toHtml($component);

        self::assertStringContainsString('<label>lastname</label>', $html);
    }
}
