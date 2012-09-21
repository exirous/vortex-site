<?php
/* @var $this RaidBossAbilityController */
/* @var $model RaidBossAbility */

$this->breadcrumbs=array(
	'Raid Boss Abilities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RaidBossAbility', 'url'=>array('index')),
	array('label'=>'Manage RaidBossAbility', 'url'=>array('admin')),
);
?>

<h1>Create RaidBossAbility</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>