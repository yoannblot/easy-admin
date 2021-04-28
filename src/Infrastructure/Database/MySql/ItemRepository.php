<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database\MySql;

use EasyAdmin\Application\Logger\Logger;
use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Exception\EntityNotFoundException;
use EasyAdmin\Domain\Database\Exception\QueryException;
use EasyAdmin\Domain\Database\ItemRepository as ItemRepositoryInterface;
use EasyAdmin\Domain\DisplayList\Filters;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use PDO;

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
            // do not use id field
            if ($itemStructure->getIdBind() === $component->getBind()) {
                continue;
            }
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

    public function get(ItemStructure $itemStructure, int $itemId): array
    {
        $query = sprintf(
            'SELECT * FROM %s WHERE %s=%d LIMIT 1',
            $itemStructure->getTable(),
            $itemStructure->getIdBind(),
            $itemId
        );

        $results = false;
        try {
            $statement = $this->connector->exec($query);
            if ($statement !== false) {
                $results = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();
            }
        } catch (QueryException $e) {
            $this->logger->queryError($e);
        }

        if ($results === false) {
            throw new EntityNotFoundException();
        }

        return $results;
    }

    public function getItemValues(ItemStructure $structure, Filters $filters): array
    {
        $orderBind = $structure->getComponentByName($filters->getOrder())->getBind();
        $query = sprintf(
            'SELECT * FROM %s ORDER BY %s %s LIMIT %d',
            $structure->getTable(),
            $orderBind,
            $filters->getOrderDirection(),
            $filters->getSize()
        );

        $statement = $this->connector->exec($query);
        $all = [];
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $elementValues) {
            $all[] = $elementValues;
        }

        return $all;
    }

    public function remove(ItemStructure $structure): bool
    {
        $query = sprintf(
            'DELETE FROM %s WHERE %s=%d LIMIT 1;',
            $structure->getTable(),
            $structure->getIdBind(),
            $structure->getId()
        );

        try {
            $this->logger->info($query);

            return $this->connector->execOnce($query);
        } catch (QueryException $e) {
            $this->logger->queryError($e);
        }

        return false;
    }

    public function update(ItemStructure $itemStructure): bool
    {
        $this->logger->info(
            sprintf('Will update item [%s] for id #%d ', $itemStructure->getName(), $itemStructure->getId())
        );

        $query = 'UPDATE ' . $itemStructure->getTable() . ' SET ';
        $queryContent = [];
        foreach ($itemStructure->getComponents() as $component) {
            // do not update id
            if ($component->getBind() === $itemStructure->getIdBind()) {
                continue;
            }

            if ($component->getValue() === null) {
                $sValue = 'NULL';
            } elseif (is_string($component->getValue())) {
                $sValue = '\'' . addslashes($component->getValue()) . '\'';
            } else {
                $sValue = $component->getValue();
            }

            $queryContent[] = $component->getBind() . ' = ' . $sValue;
        }
        if ($queryContent !== []) {
            $query .= implode(', ', $queryContent);
            $query .= ' WHERE ' . $itemStructure->getIdBind() . ' = \'' . $itemStructure->getId() . '\'';

            try {
                $this->logger->info($query);

                return $this->connector->execOnce($query);
            } catch (QueryException $e) {
                $this->logger->queryError($e);
            }
        }

        return false;
    }
}
