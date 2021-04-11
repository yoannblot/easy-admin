<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToIntegerConvertor;

final class DisplayItemsParser
{
    private ColumnsParser $columnsParser;

    private StringToIntegerConvertor $integerConvertor;

    public function __construct(ColumnsParser $columnsParser, StringToIntegerConvertor $integerConvertor)
    {
        $this->columnsParser = $columnsParser;
        $this->integerConvertor = $integerConvertor;
    }

    /**
     * @param ItemStructure $itemStructure
     * @param array         $itemsValues
     *
     * @return DisplayItem[]
     */
    public function parse(ItemStructure $itemStructure, array $itemsValues): array
    {
        $items = [];
        foreach ($itemsValues as $itemValues) {
            $id = $this->integerConvertor->convert($itemValues[$itemStructure->getIdBind()]);
            $updateUrl = sprintf('/?type=%s&page=update&id=%d', $itemStructure->getTable(), $id);
            $removeUrl = sprintf('/?type=%s&page=remove&id=%d', $itemStructure->getTable(), $id);
            $items[] = new DisplayItem(
                $this->columnsParser->parse($itemStructure, $itemValues),
                $updateUrl,
                $removeUrl
            );
        }

        return $items;
    }
}
