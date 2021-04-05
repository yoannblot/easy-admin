<?php

declare(strict_types=1);

namespace EasyAdmin\Parser\Xml\Component\Simple;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;
use EasyAdmin\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\I18N\Translator;
use EasyAdmin\Parser\Xml\Component\XmlComponentParser;
use SimpleXMLElement;

final class TextComponentParser implements XmlComponentParser
{
    private StringToBooleanConvertor $toBooleanConvertor;

    private Translator $translator;

    public function __construct(StringToBooleanConvertor $toBooleanConvertor, Translator $translator)
    {
        $this->toBooleanConvertor = $toBooleanConvertor;
        $this->translator = $translator;
    }

    public function canHandle(string $componentType): bool
    {
        return $componentType === 'text';
    }

    public function parse(SimpleXMLElement $xmlElement): TextComponent
    {
        $attributes = $xmlElement->attributes();
        $label = (string) $attributes['name'];
        $value = (string) $attributes['value'];
        $required = $this->toBooleanConvertor->convert((string) $attributes['required']);

        return new TextComponent(
            $label,
            new Label($this->translator->translate($label)),
            new TextElement($value),
            $required
        );
    }
}
