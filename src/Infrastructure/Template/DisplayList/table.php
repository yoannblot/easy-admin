<?php

use EasyAdmin\Domain\DisplayList\Column;
use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\Form\Item\ItemStructure;

/** @var $itemStructure ItemStructure */

/** @var $items DisplayItem[] */
?>
<table>
    <thead>
    <tr>
        <?php foreach ($items[array_key_first($items)]->getColumns() as $column) : ?>
            <?php /** @var Column $column */ ?>
            <th><?= $column->getLabel(); ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $displayItem) : ?>
        <tr>
            <?php foreach ($displayItem->getColumns() as $column) : ?>
                <td>
                    <?= $column->getValue(); ?>
                </td>
            <?php endforeach; ?>
            <td>
                <a href="<?= $displayItem->getUpdateUrl(); ?>">modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
