<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Simple;

use EasyAdmin\Domain\Form\Component\Simple\SelectComponent;
use EasyAdmin\Domain\Form\Element\Simple\SelectElement;
use EasyAdmin\Domain\Form\Label\Label;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Common\AttributesParser;
use EasyAdmin\Infrastructure\Parser\Xml\Component\XmlComponentParser;
use SimpleXMLElement;

final class SelectComponentParser implements XmlComponentParser
{
    private AttributesParser $attributesParser;

    private StringToBooleanConvertor $booleanConvertor;

    public function __construct(
        AttributesParser $attributesParser,
        StringToBooleanConvertor $booleanConvertor
    ) {
        $this->attributesParser = $attributesParser;
        $this->booleanConvertor = $booleanConvertor;
    }

    public function canHandle(string $componentType): bool
    {
        return $componentType === 'select';
    }

    public function parse(SimpleXMLElement $xmlElement, array $values): SelectComponent
    {
        $attributes = $this->attributesParser->parse($xmlElement);
        $selectedValue = $values[$attributes->getName()]
            ??
            $values[$attributes->getBind()]
            ??
            $attributes->getDefaultValue();

        return new SelectComponent(
            $attributes->getName(),
            new Label($attributes->getLabel()),
            new SelectElement(
                $selectedValue,
                $attributes->getBind(),
                $attributes->getValues(),
                $this->booleanConvertor->convert((string) $xmlElement->attributes()['allowEmpty'])
            ),
            $attributes->isRequired()
        );
    }
}
