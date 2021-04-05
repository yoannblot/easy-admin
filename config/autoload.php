<?php

require __DIR__ . '/../vendor/autoload.php';

use EasyAdmin\I18N\I18nLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$configurationServices = __DIR__ . '/../config/services.yaml';
$loader->load($configurationServices);

/** @var I18nLoader $i18nLoader */
$i18nLoader = $containerBuilder->get(I18nLoader::class);
$i18nLoader->load(__DIR__ . '/../config/i18n');
