<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Application\Controller\CreateController;

final class ConfigFileToHtml
{
    private CreateController $createController;

    public function __construct(CreateController $createController)
    {
        $this->createController = $createController;
    }

    public function execute(string $itemName): string
    {
        return $this->createController->index($itemName)->getContent();
    }
}
