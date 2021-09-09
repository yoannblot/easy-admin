<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database;

use EasyAdmin\Domain\Database\Connection;
use EasyAdmin\Infrastructure\Database\MySql\MysqlConnection;
use Exception;
use InvalidArgumentException;
use SimpleXMLElement;

final class ConnectionLoader
{
    public function load(string $file): Connection
    {
        $xmlElement = $this->createXmlElementFromFile($file);
        if ($this->getConnectorType($xmlElement) !== 'sql') {
            throw new InvalidArgumentException('Connector type not handled');
        }

        return new MysqlConnection(
            $this->getName($xmlElement),
            $this->getHost($xmlElement),
            $this->getLogin($xmlElement),
            $this->getPassword($xmlElement)
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    private function createXmlElementFromFile(string $path): SimpleXMLElement
    {
        try {
            $xml = new SimpleXMLElement(file_get_contents($path));
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid XML content');
        }

        if ($xml->getName() !== 'database') {
            throw new InvalidArgumentException('Primary root must be <database>');
        }

        return $xml;
    }

    private function getConnectorType(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['type'];
    }

    private function getHost(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['host'];
    }

    private function getLogin(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['login'];
    }

    private function getName(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['name'];
    }

    private function getPassword(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['password'];
    }
}
