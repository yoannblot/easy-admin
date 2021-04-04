<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Builder;

final class InputBuilder
{
    private string $type;

    private ?string $value;

    private ?string $name;

    public function __construct()
    {
        $this->type = 'text';
        $this->value = null;
        $this->name = null;
    }

    public function withType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function build(): string
    {
        $outputValue = '';
        if ($this->value !== null) {
            $outputValue = sprintf(' value="%s"', $this->value);
        }
        if ($this->name !== null) {
            $outputValue = sprintf(' name="%s"', $this->name);
        }

        return sprintf('<input type="%s"%s>', $this->type, $outputValue);
    }
}
