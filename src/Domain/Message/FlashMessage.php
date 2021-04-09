<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Message;

interface FlashMessage
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    public function getMessage(): string;
}
