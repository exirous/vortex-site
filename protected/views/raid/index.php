<?php
/* @var $this RaidController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Raids',
);

$this->menu=array(
	array('label'=>'Create Raid', 'url'=>array('create')),
	array('label'=>'Manage Raid', 'url'=>array('admin')),
);
?>

<h1>Raids</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
