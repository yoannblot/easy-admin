<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;

final class ColumnsParser
{
    /**
     * @param ItemStructure $itemStructure
     * @param DisplayItem   $displayItem
     * @param array         $itemValues
     *
     * @return Column[]
     */
    public function parse(ItemStructure $itemStructure, DisplayItem $displayItem, array $itemValues): array
    {
        $columns = [];
        foreach ($displayItem->getColumns() as $column) {
            $component = $itemStructure->getComponentByName($column->getName());
            $columnValue = $itemValues[$component->getBind()];
            $columns[] = new Column($component->getName(), $component->getName(), $columnValue);
        }

        return $columns;
    }
}
