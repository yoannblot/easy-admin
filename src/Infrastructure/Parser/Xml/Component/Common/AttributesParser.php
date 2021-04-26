<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Common;

use EasyAdmin\Domain\I18N\Translator;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToBooleanConvertor;
use SimpleXMLElement;

final class AttributesParser
{
    private StringToBooleanConvertor $toBooleanConvertor;

    private Translator $translator;

    public function __construct(StringToBooleanConvertor $toBooleanConvertor, Translator $translator)
    {
        $this->toBooleanConvertor = $toBooleanConvertor;
        $this->translator = $translator;
    }

    public function parse(SimpleXMLElement $xmlElement): ElementAttributes
    {
        $attributes = $xmlElement->attributes();
        $name = (string) $attributes['name'];
        $defaultValue = (string) $attributes['value'];
        $bind = (string) $attributes['bind'];
        $values = (string) $attributes['values'];
        $required = $this->toBooleanConvertor->convert((string) $attributes['required']);
        $label = $this->translator->translate($name);
       
        return new ElementAttributes($bind, $name, $label, $defaultValue, $required, $values);
    }
}
