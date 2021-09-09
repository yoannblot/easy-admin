<?php

declare(strict_types=1);

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Application\Router;
use EasyAdmin\Domain\I18N\LanguageDetector;
use EasyAdmin\Domain\I18N\Loader;
use EasyAdmin\Infrastructure\Database\ConnectorLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

require __DIR__ . '/../config/autoload.php';

/** @var ContainerBuilder $containerBuilder */
/** @var Router $configFileToHtml */
$configFileToHtml = $containerBuilder->get(Router::class);

/** @var ConfigurationLoader $loader */
$loader = $containerBuilder->get(ConfigurationLoader::class);
$loader->load(__DIR__ . '/../var/conf');

/** @var Loader $i18nLoader */
$i18nLoader = $containerBuilder->get(Loader::class);
$i18nLoader->load(__DIR__ . '/../var/lang');

/** @var ConnectorLoader $connectorLoader */
$connectorLoader = $containerBuilder->get(ConnectorLoader::class);
$connectorLoader->load();

$response = $configFileToHtml->execute();

if ($response instanceof JsonResponse) {
    echo $response->getContent();
    exit;
}

/** @var LanguageDetector $languageDetectory */
$languageDetectory = $containerBuilder->get(LanguageDetector::class);

$rootUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$rootUrl .= '?lang=' . $languageDetectory->detect()->getShortName();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO</title>
</head>
<body data-root-url="<?= $rootUrl; ?>">
<?= $response->getContent(); ?>
<script type="application/javascript"><?= file_get_contents(__DIR__ . '/../js/init.js'); ?></script>
</body>
</html>
