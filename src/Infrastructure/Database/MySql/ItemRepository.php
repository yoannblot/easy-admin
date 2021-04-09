<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database\MySql;

use EasyAdmin\Application\Logger\Logger;
use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Exception\QueryException;
use EasyAdmin\Domain\Database\ItemRepository as ItemRepositoryInterface;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class ItemRepository implements ItemRepositoryInterface
{
    private Connector $connector;

    private Logger $logger;

    public function __construct(Connector $connector, Logger $logger)
    {
        $this->connector = $connector;
        $this->logger = $logger;
    }

    public function create(ItemStructure $itemStructure): bool
    {
        $queryFields = [];
        $queryValues = [];
        foreach ($itemStructure->getComponents() as $component) {
            $queryFields[] = $component->getBind();
            if ($component->getValue() === null) {
                $queryValues[] = 'NULL';
            } else {
                $queryValues[] = '\'' . addslashes($component->getValue()) . '\'';
            }
        }
        $fields = implode(',', $queryFields);
        $values = implode(',', $queryValues);

        $query = sprintf('INSERT INTO %s (%s) VALUES (%s);', $itemStructure->getTable(), $fields, $values);

        try {
            return $this->connector->execOnce($query);
        } catch (QueryException $e) {
            $this->logger->queryError($e);

            return false;
        }
    }
}
