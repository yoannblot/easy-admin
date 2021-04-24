<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Common;

use EasyAdmin\Domain\I18N\Translator;
use SimpleXMLElement;

final class ValuesParser
{
    private Translator $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function parse(string $componentName, SimpleXMLElement $xmlElement): array
    {
        $values = [];
        foreach (explode('+', (string) ($xmlElement->attributes()['values'] ?? '')) as $value) {
            $translateKey = $componentName . '.' . $value;
            $values[$value] = $this->translator->translate($translateKey);
        }

        return $values;
    }
}
