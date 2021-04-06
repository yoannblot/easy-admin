<?php

require __DIR__ . '/../vendor/autoload.php';

use EasyAdmin\Domain\I18N\Loader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\Request;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$configurationServices = __DIR__ . '/../config/services.yaml';
$loader->load($configurationServices);

$request = Request::createFromGlobals();
$containerBuilder->set(Request::class, $request);

/** @var Loader $i18nLoader */
$i18nLoader = $containerBuilder->get(Loader::class);
$i18nLoader->load(__DIR__ . '/../config/i18n');
