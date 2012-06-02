<?php
$this->breadcrumbs=array(
	'Блоги'=>array('index'),
	$model->title,
);
?>

<?php 
if (Yii::app()->user->checkAccess('administrator') || Yii::app()->user->isProfileId($model->owner_id)) {
	echo CHtml::link("Добавить запись", array('post/create', 'blog_id' => $model->id), array('class' => 'btn btn-primary right')); 
}
?>

<?php 
if ($dataProvider) {
	$this->widget('zii.widgets.CListView', array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'/post/_view',
    	'template'=>"{items}\n{pager}",
	)); 
} else {
	echo 'Данный блог вам недоступен';
}

?>