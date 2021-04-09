<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Message;

final class SuccessMessage implements FlashMessage
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
