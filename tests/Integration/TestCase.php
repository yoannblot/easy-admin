<?php

declare(strict_types=1);

namespace Tests\Integration;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class TestCase extends PhpUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        global $containerBuilder;

        /** @var ConfigurationLoader $loader */
        $loader = $containerBuilder->get(ConfigurationLoader::class);
        $loader->load(__DIR__ . '/resources');
    }

    public function getService(string $className): object
    {
        global $containerBuilder;

        /** @var ContainerBuilder $containerBuilder */
        return $containerBuilder->get($className);
    }

    protected static function assertSameFileContents(string $expectedFilePath, string $actual): void
    {
        $expectedOutput = file_get_contents($expectedFilePath);

        $expectedOutput = str_replace(["\n", "    "], '', $expectedOutput);

        self::assertSame($expectedOutput, $actual);
    }
}
