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

    public function getDatabaseFile(): string
    {
        foreach ($this->directories as $directory) {
            if ($directory->hasDatabaseConfiguration()) {
                return $directory->getDatabaseConfigurationPath();
            }
        }

        throw new InvalidArgumentException('Database configuration not found.');
    }

    public function getItemFilePath(string $itemName): string
    {
        foreach ($this->directories as $directory) {
            if ($directory->hasItem($itemName)) {
                return $directory->getItemFilePath($itemName);
            }
        }

        throw new InvalidArgumentException('Item not found with name ' . $itemName);
    }

    public function getListFilePath(string $itemName): string
    {
        foreach ($this->directories as $directory) {
            if ($directory->hasList($itemName)) {
                return $directory->getListFilePath($itemName);
            }
        }

        throw new InvalidArgumentException('List not found with name ' . $itemName);
    }

    public function load(string $directory): void
    {
        $this->directories[] = new Directory($directory);
    }
}
