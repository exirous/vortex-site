<?php
$this->breadcrumbs=array(
	'Черновики'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Черновики', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Админка', 'url'=>array('admin')),
);
?>

<div class="box_content">
	<h2>Редактировать</h2>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>