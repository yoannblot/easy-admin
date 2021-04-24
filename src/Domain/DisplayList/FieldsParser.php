<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use InvalidArgumentException;

final class FieldsParser
{
    /**
     * @param ItemStructure $itemStructure
     * @param DisplayItem   $displayItem
     * @param string[]      $itemValues
     *
     * @return Field[]
     *
     * @throws InvalidArgumentException
     */
    public function parse(ItemStructure $itemStructure, DisplayItem $displayItem, array $itemValues): array
    {
        $columns = [];
        foreach ($displayItem->getFields() as $field) {
            $component = $itemStructure->getComponentByName($field->getName());
            $fieldValue = $itemValues[$component->getBind()] ?? '';
            $columns[] = new Field($field->getName(), $field->getLabel(), $fieldValue);
        }

        return $columns;
    }
}
