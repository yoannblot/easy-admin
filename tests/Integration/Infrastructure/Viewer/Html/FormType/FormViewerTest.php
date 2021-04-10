<?php

declare(strict_types=1);

namespace Tests\Integration\Infrastructure\Viewer\Html\FormType;

use EasyAdmin\Infrastructure\Viewer\Html\FormType\FormViewer;
use Tests\Builder\Form\FormType\FormBuilder;
use Tests\Integration\TestCase;

final class FormViewerTest extends TestCase
{
    /**
     * @test
     *
     * @throws
     */
    public function it_creates_an_html_form(): void
    {
        /** @var FormViewer $formViewer */
        $formViewer = $this->getService(FormViewer::class);

        $form = (new FormBuilder())->build();

        $html = $formViewer->toHtml($form);

        self::assertStringContainsString('<form', $html);
    }
}
