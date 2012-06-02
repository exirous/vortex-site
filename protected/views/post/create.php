<?php
$this->breadcrumbs=array(
	'Создать запись',
);

$this->menu=array(
	array('label'=>'Черновики', 'url'=>array('index')),
	array('label'=>'Администрирование', 'url'=>array('admin')),
);
?>
<div class="box_content">
	<h2>Создать запись</h2>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>