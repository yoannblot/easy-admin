<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer;

use EasyAdmin\Form\Item\ItemStructure;
use EasyAdmin\Viewer\Html\Component\HtmlComponentViewer;

final class HtmlViewer
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
