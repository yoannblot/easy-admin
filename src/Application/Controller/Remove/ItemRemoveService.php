<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Remove;

use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Message\FlashMessage;
use EasyAdmin\Domain\Message\FlashMessageFactory;
use EasyAdmin\Infrastructure\Viewer\Html\Message\FlashMessageViewer;

final class ItemRemoveService
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

    public function removeAndRetrieveOutput(ItemStructure $itemStructure): string
    {
        $isCreationSuccess = $this->itemRepository->remove($itemStructure);
        if ($isCreationSuccess) {
            $message = $this->messageFactory->create(FlashMessage::SUCCESS, 'removeSuccess');
        } else {
            $message = $this->messageFactory->create(FlashMessage::ERROR, 'removeFailed');
        }

        return $this->messageViewer->toHtml($message);
    }
}
