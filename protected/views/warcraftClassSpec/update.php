<?php

$this->breadcrumbs=array(
	'Warcraft Class Specs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Администрирование', 'url'=>array('admin')),
);
?>

<h1>Редактирование WarcraftClassSpec <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>