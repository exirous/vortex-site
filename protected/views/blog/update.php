<?php
$this->breadcrumbs=array(
	'Блоги'=>array('index'),
	$model->title,
);
?>

<h2>Изменить блог</h2>

<div class='box_content'>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>