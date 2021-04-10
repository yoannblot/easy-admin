<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Update;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Message\FlashMessage;
use EasyAdmin\Domain\Message\FlashMessageFactory;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use EasyAdmin\Infrastructure\Viewer\Html\Message\FlashMessageViewer;

final class ItemUpdator
{
    private ItemRepository $itemRepository;

    private FlashMessageFactory $messageFactory;

    private FlashMessageViewer $messageViewer;

    public function __construct(
        ItemRepository $itemRepository,
        FlashMessageFactory $messageFactory,
        FlashMessageViewer $messageViewer
    ) {
        $this->itemRepository = $itemRepository;
        $this->messageFactory = $messageFactory;
        $this->messageViewer = $messageViewer;
    }

    public function updateAndRetrieveOutput(ItemStructure $itemStructure): string
    {
        $isCreationSuccess = $this->itemRepository->update($itemStructure);
        if ($isCreationSuccess) {
            $message = $this->messageFactory->create(FlashMessage::SUCCESS, 'updateSuccess');
        } else {
            $message = $this->messageFactory->create(FlashMessage::ERROR, 'updateFailed');
        }

        return $this->messageViewer->toHtml($message);
    }
}
