<?php
$this->breadcrumbs=array(
	'����������� �������� ������'=>array('index'),
	'�������',
);

$this->menu=array(
	array('label'=>'������', 'url'=>array('index')),
	array('label'=>'�����������������', 'url'=>array('admin')),
);
?>

<h1>�������</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>