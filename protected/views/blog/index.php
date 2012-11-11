<?php
$this->breadcrumbs=array(
	'Блоги',
);
?>

<h2>Блоги <?php 
if (Yii::app()->user->checkAccess('raider')) {
	echo CHtml::link("Создать блог", array('blog/create'), array('class' => 'btn btn-primary right')); 
}
?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>