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
        $attributes = '';
        if ($this->name !== null) {
            $attributes .= sprintf(' name="%s"', $this->name);
        }
        if ($this->value !== null) {
            $attributes .= sprintf(' value="%s"', $this->value);
        }

        return sprintf('<input type="%s"%s>', $this->type, $attributes);
    }
}
