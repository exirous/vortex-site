<?php

$this->profileMenu=array(
	array('label'=>'Создать статью', 'url'=>array('create')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',		
	'template'=>"{items}\n{pager}",
)); ?>