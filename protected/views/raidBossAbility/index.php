<?php
/* @var $this RaidBossAbilityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Raid Boss Abilities',
);

$this->menu=array(
	array('label'=>'Create RaidBossAbility', 'url'=>array('create')),
	array('label'=>'Manage RaidBossAbility', 'url'=>array('admin')),
);
?>

<h1>Raid Boss Abilities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
