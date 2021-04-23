<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Message;

use EasyAdmin\Domain\I18N\Translator;
use InvalidArgumentException;

final class FlashMessageFactory
{
    private Translator $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function create(string $type, string $message): FlashMessage
    {
        if ($type === 'success') {
            return new SuccessMessage($this->translator->translate($message));
        }

        if ($type === 'error') {
            return new ErrorMessage($this->translator->translate($message));
        }

        throw new InvalidArgumentException(sprintf('Message type "%s" does not exist', $type));
    }
}
