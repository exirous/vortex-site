<?php
/* @var $this RaidBossAbilityController */
/* @var $model RaidBossAbility */

$this->breadcrumbs=array(
	'Raid Boss Abilities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RaidBossAbility', 'url'=>array('index')),
	array('label'=>'Create RaidBossAbility', 'url'=>array('create')),
	array('label'=>'Update RaidBossAbility', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RaidBossAbility', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RaidBossAbility', 'url'=>array('admin')),
);
?>

<h1>View RaidBossAbility #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'parent_id',
		'raid_boss_id',
	),
)); ?>
