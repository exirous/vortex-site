<?php
/* @var $this RaidBossController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Raid Bosses',
);

$this->menu=array(
	array('label'=>'Create RaidBoss', 'url'=>array('create')),
	array('label'=>'Manage RaidBoss', 'url'=>array('admin')),
);
?>

<h1>Raid Bosses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
