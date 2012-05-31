<?php
$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список блогов', 'url'=>array('index')),
	array('label'=>'Создать блог', 'url'=>array('create')),
	array('label'=>'Изменить блог', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный объект?')),
	array('label'=>'Управление блогом', 'url'=>array('admin')),
);
?>

<h2>Просмотр блога #<?php echo $model->id; ?></h2>

<div class='box_content'>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'title',
			'owner.user_email',
			'created',
			'updated',
		),
	)); ?>
</div>