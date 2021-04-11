<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Domain\Form\Button\CreateButton;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\I18N\Translator;

final class FormFactory
{
    private FormTagFactory $formTagFactory;

    private Translator $translator;

    public function __construct(
        FormTagFactory $formTagFactory,
        Translator $translator
    ) {
        $this->formTagFactory = $formTagFactory;
        $this->translator = $translator;
    }

    /**
     * @param ItemStructure $itemStructure
     *
     * @return Form
     */
    public function createForm(ItemStructure $itemStructure): Form
    {
        return new BasicForm(
            $this->formTagFactory->getCreateFormTag($itemStructure),
            $itemStructure,
            new CreateButton(
                'create-' . $itemStructure->getName(),
                $this->translator->translate('submit')
            )
        );
    }

    /**
     * @param ItemStructure $itemStructure
     *
     * @return Form
     */
    public function updateForm(ItemStructure $itemStructure): Form
    {
        return new BasicForm(
            $this->formTagFactory->getUpdateFormTag($itemStructure),
            $itemStructure,
            new CreateButton(
                'update-' . $itemStructure->getName(),
                $this->translator->translate('submit')
            )
        );
    }

    /**
     * @param ItemStructure $itemStructure
     *
     * @return Form
     */
    public function removeForm(ItemStructure $itemStructure): Form
    {
        return new BasicForm(
            $this->formTagFactory->getRemoveFormTag($itemStructure),
            $itemStructure,
            new CreateButton(
                'remove-' . $itemStructure->getName(),
                $this->translator->translate('removeConfirm')
            )
        );
    }
}
