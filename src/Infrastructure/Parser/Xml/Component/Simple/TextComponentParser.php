<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Simple;

use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use EasyAdmin\Domain\Form\Element\Simple\TextElement;
use EasyAdmin\Domain\Form\Label\Label;
use EasyAdmin\Domain\I18N\Translator;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\Infrastructure\Parser\Xml\Component\XmlComponentParser;
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

    public function parse(SimpleXMLElement $xmlElement, array $values): TextComponent
    {
        $attributes = $this->getAttributes($xmlElement);
        $label = $attributes['label'];
        if (array_key_exists($label, $values)) {
            $value = (string) $values[$label];
        } else {
            $value = $attributes['defaultValue'];
        }

        return new TextComponent(
            $attributes['label'],
            new Label($this->translator->translate($attributes['label'])),
            new TextElement($value, $attributes['bind']),
            $attributes['required']
        );
    }

    private function getAttributes(SimpleXMLElement $xmlElement): array
    {
        $attributes = $xmlElement->attributes();
        $label = (string) $attributes['name'];
        $defaultValue = (string) $attributes['value'];
        $bind = (string) $attributes['bind'];
        $required = $this->toBooleanConvertor->convert((string) $attributes['required']);

        return ['label' => $label, 'bind' => $bind, 'defaultValue' => $defaultValue, 'required' => $required];
    }
}
