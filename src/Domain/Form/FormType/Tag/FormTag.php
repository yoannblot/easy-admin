<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType\Tag;

final class FormTag
{
    private string $id;

    private string $name;

    private string $method;

    private string $action;

    public function __construct(string $id, string $name, string $method, string $action)
    {
        $this->id = $id;
        $this->name = $name;
        $this->method = $method;
        $this->action = $action;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
