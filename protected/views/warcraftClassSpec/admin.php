<?php

$this->breadcrumbs=array(
	'Warcraft Class Specs'=>array('index'),
	'Администрирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('warcraft-class-spec-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Администрирование Warcraft Class Specs</h1>

<?php echo CHtml::link('Продвинутый поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'warcraft-class-spec-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'warcraft_class_id',
		'name',
		'english_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
