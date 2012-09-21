<?php
/* @var $this RaidBossController */
/* @var $model RaidBoss */

$this->breadcrumbs=array(
	'Raid Bosses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RaidBoss', 'url'=>array('index')),
	array('label'=>'Manage RaidBoss', 'url'=>array('admin')),
);
?>

<h1>Create RaidBoss</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>