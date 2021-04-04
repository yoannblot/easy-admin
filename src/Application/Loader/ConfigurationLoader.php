<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Loader;

use InvalidArgumentException;

final class ConfigurationLoader
{
    /**
     * @var Directory[]
     */
    private array $directories;

    public function __construct()
    {
        $this->directories = [];
    }

    public function getFilePath(string $itemName): string
    {
        foreach ($this->directories as $directory) {
            if ($directory->has($itemName)) {
                return $directory->getFilePath($itemName);
            }
        }

        throw new InvalidArgumentException('Item not found with name ' . $itemName);
    }

    public function load(string $directory): void
    {
        $this->directories[] = new Directory($directory);
    }
}
