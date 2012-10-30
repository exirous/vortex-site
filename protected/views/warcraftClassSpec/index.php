<?php

$this->breadcrumbs=array(
	'Warcraft Class Specs',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Администрировать', 'url'=>array('admin')),
);
?>

<h1>Warcraft Class Specs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); ?>
