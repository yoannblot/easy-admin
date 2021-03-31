<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Builder;

final class InputBuilder
{
    private string $type;

    private string $value;

    public function __construct()
    {
        $this->type = 'text';
        $this->value = '';
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): string
    {
        $outputValue = '';
        if ($this->value !== '') {
            $outputValue = sprintf(' value="%s"', $this->value);
        }

        return sprintf('<input type="%s"%s>', $this->type, $outputValue);
    }
}
