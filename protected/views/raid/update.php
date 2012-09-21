<?php
/* @var $this RaidController */
/* @var $model Raid */

$this->breadcrumbs=array(
	'Raids'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Raid', 'url'=>array('index')),
	array('label'=>'Create Raid', 'url'=>array('create')),
	array('label'=>'View Raid', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Raid', 'url'=>array('admin')),
);
?>

<h1>Update Raid <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>