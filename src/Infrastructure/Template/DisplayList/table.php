<?php

use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\Form\Item\ItemStructure;

/** @var $itemStructure ItemStructure */

/** @var $items DisplayItem[] */
?>
<table>
    <thead>
    <tr>
        <?php foreach ($items[array_key_first($items)]->getFields() as $field) : ?>
            <th><?= $field->getLabel(); ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $displayItem) : ?>
        <tr>
            <?php foreach ($displayItem->getFields() as $field) : ?>
                <td>
                    <?= $field->getValue(); ?>
                </td>
            <?php endforeach; ?>
            <td>
                <a href="<?= $displayItem->getUpdateUrl(); ?>">modifier</a>
            </td>
            <td>
                <a href="<?= $displayItem->getRemoveUrl(); ?>">supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
