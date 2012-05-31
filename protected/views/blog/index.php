<?php
$this->breadcrumbs=array(
	'Blogs',
);

$this->menu=array(
	array('label'=>'Список блогов', 'url'=>array('create')),
	array('label'=>'Управление блогом', 'url'=>array('admin')),
);
?>

<h2>Blogs</h2>

<div class='box_content'>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
</div>