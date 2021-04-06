<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\FormType;

use EasyAdmin\Application\FormTagFactory;
use EasyAdmin\Domain\Form\Button\CreateButton;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\I18N\Translator;
use InvalidArgumentException;

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
     * @param string        $formType
     *
     * @return Form
     *
     * @throws InvalidArgumentException
     */
    public function createForm(ItemStructure $itemStructure, string $formType): Form
    {
        if ($formType === 'create') {
            return new CreateForm(
                $this->formTagFactory->getCreateFormTag($itemStructure),
                $itemStructure,
                new CreateButton(
                    'create-' . $itemStructure->getName(),
                    $this->translator->translate('submit')
                )
            );
        }

        throw new InvalidArgumentException(sprintf('Invalid form type "%s"', $formType));
    }
}
