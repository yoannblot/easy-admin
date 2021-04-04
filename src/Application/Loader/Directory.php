<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Loader;

final class Directory
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function has(string $itemName): bool
    {
        return file_exists($this->getFilePath($itemName));
    }

    public function getFilePath(string $itemName): string
    {
        return sprintf('%s/items/%s.xml', $this->path, $itemName);
    }
}
