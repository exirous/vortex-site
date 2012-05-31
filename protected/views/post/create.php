<?php
$this->breadcrumbs=array(
	'Черновики'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Черновики', 'url'=>array('index')),
	array('label'=>'Администрирование', 'url'=>array('admin')),
);
?>
<div class="box_content">
	<h2>Создать черновик</h2>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>