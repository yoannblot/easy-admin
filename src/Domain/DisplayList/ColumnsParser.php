<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;

final class ColumnsParser
{
    /**
     * @param ItemStructure $itemStructure
     * @param array         $itemValues
     *
     * @return Column[]
     */
    public function parse(ItemStructure $itemStructure, array $itemValues): array
    {
        $columns = [];
        foreach ($itemValues as $columnBind => $columnValue) {
            $component = $itemStructure->getComponentByBind($columnBind);
            $columns[] = new Column($component->getName(), $component->getName(), $columnValue);
        }

        return $columns;
    }
}
