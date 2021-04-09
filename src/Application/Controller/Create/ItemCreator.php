<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Create;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Message\FlashMessage;
use EasyAdmin\Domain\Message\FlashMessageFactory;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use EasyAdmin\Infrastructure\Viewer\Html\Message\FlashMessageViewer;

final class ItemCreator
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

    public function createAndRetrieveOutput(ItemStructure $itemStructure): string
    {
        $isCreationSuccess = $this->itemRepository->create($itemStructure);
        if ($isCreationSuccess) {
            $message = $this->messageFactory->create(FlashMessage::SUCCESS, 'createSuccess');
        } else {
            $message = $this->messageFactory->create(FlashMessage::ERROR, 'createFailed');
        }

        return $this->messageViewer->toHtml($message);
    }
}
