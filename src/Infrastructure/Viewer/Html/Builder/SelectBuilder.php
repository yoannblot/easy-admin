<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Builder;

final class SelectBuilder
{
    private ?string $selectedValue;

    private ?string $name;

    private ?string $id;

    private bool $required;

    private string $values;

    private bool $emptyValueAllowed;

    public function __construct()
    {
        $this->selectedValue = null;
        $this->name = null;
        $this->id = null;
        $this->required = false;
        $this->values = '';
        $this->emptyValueAllowed = false;
    }

    public function build(): string
    {
        $attributes = '';
        if ($this->name !== null) {
            $attributes .= sprintf(' name="%s"', $this->name);
        }
        if ($this->id !== null) {
            $attributes .= sprintf(' id="%s"', $this->id);
        }
        if ($this->required) {
            $attributes .= ' required="required"';
        }

        $options = '';
        if ($this->emptyValueAllowed) {
            if ($this->selectedValue === null) {
                $options .= '<option value="" selected="selected"></option>';
            } else {
                $options .= '<option value=""></option>';
            }
        }
        $attributes .= sprintf(' data-values="%s"', rawurlencode($this->values));

        return sprintf('<select %s>%s</select>', $attributes, $options);
    }

    public function emptyValueAllowed(): self
    {
        $this->emptyValueAllowed = true;

        return $this;
    }

    public function required(): self
    {
        $this->required = true;

        return $this;
    }

    public function withId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withSelectedValue(string $value): self
    {
        $this->selectedValue = $value;

        return $this;
    }

    public function withValues(string $values): self
    {
        $this->values = $values;

        return $this;
    }
}
