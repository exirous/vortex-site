<?php
/* @var $this RaidController */
/* @var $model Raid */

$this->breadcrumbs=array(
	'Raids'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Raid', 'url'=>array('index')),
	array('label'=>'Manage Raid', 'url'=>array('admin')),
);
?>

<h1>Create Raid</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>