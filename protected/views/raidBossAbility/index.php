<?php

$this->breadcrumbs=array(
	'Способности рейдовых боссов',
);

$this->menu=array(
	array('label'=>'Добавить способность босса', 'url'=>array('create')),
	array('label'=>'Управлять способностями босса', 'url'=>array('admin')),
);
?>

<h1>Способности рейдовых боссов</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); ?>
