<?php

use EasyAdmin\Domain\Form\Item\ItemStructure;

/** @var $itemStructure ItemStructure */

/** @var $items array */
?>
<table>
    <thead>
    <tr>
        <?php foreach (array_keys($items[0]) as $label) : ?>
            <th><?= $label; ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $itemValues) : ?>
        <tr>
            <?php foreach ($itemValues as $elementValue) : ?>
                <td>
                    <?= $elementValue; ?>
                </td>
            <?php endforeach; ?>
            <td>
                <a href="<?= sprintf('/?type=%s&page=update&id=%d', $itemStructure->getTable(), $itemValues['id']); ?>">modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
