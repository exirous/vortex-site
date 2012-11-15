<?
?>
<h2><?=$model->name?></h2>

<?php
if (count($model->lastCharacterItemSet)) {
    $itemSet = $model->getLastCharacterItemSet();
    $itemSet->refresh();
    $lastCharacterItemSet = json_decode($itemSet->raw_data);

    $slots = array();
    foreach ($lastCharacterItemSet as $item_key => $item) {
        if (!(($item_key == 'averageItemLevel') or ($item_key == 'averageItemLevelEquipped') or ($item_key == 'shirt'))) {
            $slots[] = $item_key;
        }
    }?>

    <ul>
    <?

    foreach ($slots as $item_key) {?>
        <li class="item_quality_<?=$lastCharacterItemSet->$item_key->quality?>">
            <? $item = Item::getItemById($lastCharacterItemSet->$item_key->id);?>
            <a href="#" rel="item=<?=$item->id?>;domain=ru"><?=$lastCharacterItemSet->$item_key->name?></a>
            <?=$item->item_level;?>
        </li>
    <?}?>
    </ul>
    <p>GearScore:<?=$itemSet->gear_score?>. ItemLevel: <?=$itemSet->item_level?></p>
<? } ?>