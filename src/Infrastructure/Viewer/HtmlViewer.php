<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Viewer\Html\Viewer;
use EasyAdmin\Infrastructure\Viewer\Html\Component\HtmlComponentViewer;

final class HtmlViewer implements Viewer
{
    /**
     * @var HtmlComponentViewer[]
     */
    private array $viewers;

    /**
     * @param HtmlComponentViewer[] $viewers
     */
    public function __construct(array $viewers)
    {
        $this->viewers = $viewers;
    }

    public function toHtml(ItemStructure $structure): string
    {
        $html = '';
        foreach ($structure->getComponents() as $component) {
            foreach ($this->viewers as $viewer) {
                $html .= $viewer->toHtml($component);
            }
        }

        return $html;
    }
}
