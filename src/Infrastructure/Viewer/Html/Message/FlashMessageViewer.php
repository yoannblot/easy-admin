<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Message;

use EasyAdmin\Domain\Message\FlashMessage;

final class FlashMessageViewer
{
    public function toHtml(FlashMessage $message): string
    {
        return $message->getMessage();
    }
}
