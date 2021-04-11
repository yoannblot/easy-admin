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

    public function hasItem(string $itemName): bool
    {
        return file_exists($this->getItemFilePath($itemName));
    }

    public function getItemFilePath(string $itemName): string
    {
        return sprintf('%s/items/%s.xml', $this->path, $itemName);
    }

    public function hasList(string $itemName): bool
    {
        return file_exists($this->getListFilePath($itemName));
    }

    public function getListFilePath(string $itemName): string
    {
        return sprintf('%s/list/%s.xml', $this->path, $itemName);
    }
}
