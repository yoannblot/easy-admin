<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;

final class FieldsParser
{
    /**
     * @param ItemStructure $itemStructure
     * @param DisplayItem   $displayItem
     * @param array         $itemValues
     *
     * @return Field[]
     */
    public function parse(ItemStructure $itemStructure, DisplayItem $displayItem, array $itemValues): array
    {
        $columns = [];
        foreach ($displayItem->getFields() as $column) {
            $component = $itemStructure->getComponentByName($column->getName());
            $fieldValue = $itemValues[$component->getBind()];
            $columns[] = new Field($component->getName(), $component->getName(), $fieldValue);
        }

        return $columns;
    }
}
