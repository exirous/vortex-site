<?php

$this->breadcrumbs=array(
	'Стримы'=>array('index'),
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

<h1><?php echo $model->name; ?></h1>


