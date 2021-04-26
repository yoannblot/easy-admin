<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Common;

use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\DisplayList\Filters;
use EasyAdmin\Domain\Form\Item\ItemFactory;
use EasyAdmin\Domain\I18N\Translator;

final class ValuesParser
{
    private Translator $translator;

    private ItemFactory $itemFactory;

    private ItemRepository $repository;

    public function __construct(Translator $translator, ItemFactory $itemFactory, ItemRepository $repository)
    {
        $this->translator = $translator;
        $this->itemFactory = $itemFactory;
        $this->repository = $repository;
    }

    public function parse(string $componentName, string $configValues): array
    {
        if (strpos($configValues, 'item:') === 0) {
            return $this->fromItem($configValues);
        }

        return $this->fromList($configValues, $componentName);
    }

    private function fromItem(string $configValues): array
    {
        // get fields from conf
        $configValues = str_replace('item:', '', $configValues);
        [$itemName, $displayFields, $orderField] = array_pad(explode('|', $configValues, 3), 3, false);

        // get results
        $itemStructure = $this->itemFactory->get($itemName);

        // TODO handle order
//        if ( $orderField) {
//            $orderField = self::formatName($orderField);
//            if ('id' === $orderField) {
//                $orderField = $itemStructure->getIdBind();
//            } else {
//                $oElement = $itemStructure->getElementFromName($orderField);
//                if ($oElement instanceof AbstractElement) {
//                    $orderField = $oElement->getBind();
//                }
//            }
//        }

        $fieldBinds = [];
        // TODO multiple fields
//        if (false !== strpos($displayFields, '+')) {
//            $aFields = explode('+', $displayFields);
//            foreach ($aFields as $sFieldName) {
//                $oElement = $itemStructure->getElementFromName(self::formatName($sFieldName));
//                if ($oElement instanceof AbstractElement) {
//                    $aFieldBinds[] = $oElement->getBind();
//                }
//            }
//        } else {
        $oElement = $itemStructure->getComponentByName($displayFields);
        $fieldBinds[] = $oElement->getBind();
//        }

        // TODO order direction
        // TODO unlimited size
        $filters = new Filters($orderField, 'ASC', 100);

        $values = [];
        foreach ($this->repository->getItemValues($itemStructure, $filters) as $itemValue) {
            $text = '';
            $count = 0;
            foreach ($fieldBinds as $fieldBind) {
                $text .= ($count++ > 0 ? ' ' : null) . $itemValue[$fieldBind];
            }
            $values[$itemValue[$itemStructure->getIdBind()]] = $text;
        }

        return $values;
    }

    private function fromList(string $configValues, string $componentName): array
    {
        $values = [];
        foreach (explode('+', $configValues) as $value) {
            $translateKey = $componentName . '.' . $value;
            $values[$value] = $this->translator->translate($translateKey);
        }

        return $values;
    }
}
