<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Database\Connector;

final class ConnectorLoader
{
    private Connector $connector;
    private ConfigurationLoader $configurationLoader;
    private ConnectionLoader $connectionLoader;

    public function __construct(
        Connector $connector,
        ConfigurationLoader $configurationLoader,
        ConnectionLoader $connectionLoader
    ) {
        $this->connector = $connector;
        $this->configurationLoader = $configurationLoader;
        $this->connectionLoader = $connectionLoader;
    }

    public function load(): Connector
    {
        $this->connector->load(
            $this->connectionLoader->load(
                $this->configurationLoader->getDatabaseFile()
            )
        );

        return $this->connector;
    }
}
