<?php
/* @var $this RaidBossController */
/* @var $model RaidBoss */

$this->breadcrumbs=array(
	'Raid Bosses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RaidBoss', 'url'=>array('index')),
	array('label'=>'Create RaidBoss', 'url'=>array('create')),
	array('label'=>'View RaidBoss', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RaidBoss', 'url'=>array('admin')),
);
?>

<h1>Update RaidBoss <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>