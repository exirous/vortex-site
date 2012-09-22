<?php

$this->breadcrumbs=array(
	'Стримы',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Администрировать', 'url'=>array('admin')),
);
?>

<h1>Стримы</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); ?>
