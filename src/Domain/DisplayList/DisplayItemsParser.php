<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToIntegerConvertor;

final class DisplayItemsParser
{
    private FieldsParser $columnsParser;

    private StringToIntegerConvertor $integerConvertor;

    public function __construct(FieldsParser $columnsParser, StringToIntegerConvertor $integerConvertor)
    {
        $this->columnsParser = $columnsParser;
        $this->integerConvertor = $integerConvertor;
    }

    /**
     * @param ItemStructure $itemStructure
     * @param DisplayItem   $displayItem
     * @param array         $itemsValues
     *
     * @return DisplayItem[]
     */
    public function parse(ItemStructure $itemStructure, DisplayItem $displayItem, array $itemsValues): array
    {
        $items = [];
        foreach ($itemsValues as $itemValues) {
            $id = $this->integerConvertor->convert($itemValues[$itemStructure->getIdBind()]);
            $updateUrl = sprintf('/?type=%s&page=update&id=%d', $itemStructure->getTable(), $id);
            $removeUrl = sprintf('/?type=%s&page=remove&id=%d', $itemStructure->getTable(), $id);
            $items[] = new DisplayItem(
                $displayItem->getFilters(),
                $this->columnsParser->parse($itemStructure, $displayItem, $itemValues),
                $updateUrl,
                $removeUrl
            );
        }

        return $items;
    }
}
