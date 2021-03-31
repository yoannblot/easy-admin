<?php

declare(strict_types=1);

namespace EasyAdmin\View;

use EasyAdmin\Form\Item\ItemStructure;
use EasyAdmin\View\Html\Component\HtmlComponentView;

final class HtmlViewer
{
    /**
     * @var HtmlComponentView[]
     */
    private array $viewers;

    /**
     * @param HtmlComponentView[] $viewers
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
