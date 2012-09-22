<div class="view">
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

    <?php if ($data->parent) {?>
	    <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>

        <?php echo CHtml::link(CHtml::encode($data->parent->name), array('view', 'id'=>$data->id)); ?>
	    <br />
    <?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('raid_boss_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->raidBoss->name), array('raidBoss/view', 'id'=>$data->id)); ?>
	<br />
</div>
<hr/>