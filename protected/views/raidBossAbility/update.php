<?php
/* @var $this RaidBossAbilityController */
/* @var $model RaidBossAbility */

$this->breadcrumbs=array(
	'Raid Boss Abilities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RaidBossAbility', 'url'=>array('index')),
	array('label'=>'Create RaidBossAbility', 'url'=>array('create')),
	array('label'=>'View RaidBossAbility', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RaidBossAbility', 'url'=>array('admin')),
);
?>

<h1>Update RaidBossAbility <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>