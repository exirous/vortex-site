<?php
/* @var $this RaidController */
/* @var $model Raid */

$this->breadcrumbs=array(
	'Raids'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Raid', 'url'=>array('index')),
	array('label'=>'Create Raid', 'url'=>array('create')),
	array('label'=>'Update Raid', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Raid', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Raid', 'url'=>array('admin')),
);
?>

<h1>View Raid #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'location_id',
		'difficulty',
		'quantity',
	),
)); ?>
