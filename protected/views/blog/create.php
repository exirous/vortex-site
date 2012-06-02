<?php
$this->breadcrumbs=array(
	'Блоги'=>array('index'),
	'Создать',
);

?>

<h2>Создать блог</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>