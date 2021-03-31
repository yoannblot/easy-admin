<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Parser\Parser;
use EasyAdmin\Viewer\HtmlViewer;

final class ConfigFileToHtml
{
    private Parser $parser;

    private HtmlViewer $htmlViewer;

    public function __construct(Parser $parser, HtmlViewer $htmlViewer)
    {
        $this->parser = $parser;
        $this->htmlViewer = $htmlViewer;
    }

    public function execute(string $filePath): string
    {
        return $this->htmlViewer->toHtml(
            $this->parser->parse($filePath)
        );
    }
}
