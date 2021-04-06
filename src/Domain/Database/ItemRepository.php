<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\Form\Item\ItemStructure;

final class ItemRepository
{
    private Connector $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
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

        return $this->connector->execOnce($query);
    }
}
