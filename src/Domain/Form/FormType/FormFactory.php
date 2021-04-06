<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Application\FormTagFactory;
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
        return new CreateForm(
            $this->formTagFactory->getCreateFormTag($itemStructure),
            $itemStructure,
            new CreateButton(
                'create-' . $itemStructure->getName(),
                $this->translator->translate('submit')
            )
        );
    }
}
