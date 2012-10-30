<?php

$this->breadcrumbs=array(
	'Warcraft Class Specs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить?')),
	array('label'=>'Администрировать', 'url'=>array('admin')),
);
?>

<h1>View WarcraftClassSpec #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'warcraft_class_id',
		'name',
		'english_name',
	),
)); ?>
