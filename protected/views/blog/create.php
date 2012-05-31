<?php
$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список блогов', 'url'=>array('index')),
	array('label'=>'Управление блогом', 'url'=>array('admin')),
);
?>

<h2>Создать блог</h2>

<div class='box_content'>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>