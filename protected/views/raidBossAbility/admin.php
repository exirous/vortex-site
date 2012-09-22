<?php

$this->breadcrumbs=array(
	'Raid Boss Abilities'=>array('index'),
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
	$.fn.yiiGridView.update('raid-boss-ability-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Администрирование</h1>

<?php echo CHtml::link('Продвинутый поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'raid-boss-ability-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'description',
		'parent.name',
		'raidBoss.name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
