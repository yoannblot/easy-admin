<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Message;

use InvalidArgumentException;

final class FlashMessageFactory
{
    public function create(string $type, string $message): FlashMessage
    {
        if ($type === 'success') {
            return new SuccessMessage($message);
        }

        if ($type === 'error') {
            return new ErrorMessage($message);
        }

        throw new InvalidArgumentException('Message type "%s" does not exist', $type);
    }
}
