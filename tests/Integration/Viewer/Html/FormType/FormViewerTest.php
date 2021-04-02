<?php

declare(strict_types=1);

namespace Tests\Integration\Viewer\Html\FormType;

use EasyAdmin\Viewer\Html\FormType\FormViewer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tests\Builder\Form\FormType\CreateFormBuilder;

final class FormViewerTest extends TestCase
{
    /**
     * @test
     *
     * @throws
     */
    public function it_creates_an_html_form(): void
    {
        global $containerBuilder;
        /** @var ContainerBuilder $containerBuilder */

        /** @var FormViewer $formViewer */
        $formViewer = $containerBuilder->get(FormViewer::class);

        $form = (new CreateFormBuilder())->build();

        $html = $formViewer->toHtml($form);

        self::assertStringContainsString('<form', $html);
    }
}
