<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class TestCase extends PhpUnitTestCase
{
    public function getService(string $className): object
    {
        global $containerBuilder;

        /** @var ContainerBuilder $containerBuilder */

        return $containerBuilder->get($className);
    }
}
