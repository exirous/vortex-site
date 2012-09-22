<?php
/* @var $this RaidBossAbilityController */
/* @var $model RaidBossAbility */

$this->breadcrumbs=array(
	'Способности рейдовых боссов'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить?')),
	array('label'=>'Администрирование', 'url'=>array('admin')),
);
?>

<h1>Просмотр способности рейдового босса #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'parent_id',
		'raid_boss_id',
	),
)); ?>
