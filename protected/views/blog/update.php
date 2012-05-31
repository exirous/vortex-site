<?php
$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список блогов', 'url'=>array('index')),
	array('label'=>'Создать блог', 'url'=>array('create')),
	array('label'=>'Просмотреть блог', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление блогом', 'url'=>array('admin')),
);
?>

<h2>Изменить блог <?php echo $model->id; ?></h2>

<div class='box_content'>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>