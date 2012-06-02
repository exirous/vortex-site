<?php
$this->breadcrumbs=array(
	'Блоги'=>array('index'),
	$model->title,
);
?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/post/_view',
    'template'=>"{items}\n{pager}",
)); ?>