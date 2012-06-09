<?php
$title = $model->title;

$this->breadcrumbs=array(
	'Блоги'=>array('index'),
    $title,
);
?>

<div class="actions right">
<?php 
if (Yii::app()->user->checkAccess('blog_author', array('blog' => $model))) {
	echo CHtml::link("Добавить запись", array('post/create', 'blog_id' => $model->id), array('class' => 'btn btn-primary'));
}
    echo "&nbsp";
if (Yii::app()->user->checkAccess('blog_owner', array('blog' => $model))) {
    echo CHtml::link("Добавить автора", array('blog/addAuthor', 'id' => $model->id), array('class' => 'btn btn-primary'));
}
?>
</div>

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