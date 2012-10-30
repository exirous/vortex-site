<?php
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10, 'class'=>'input-xxlarge'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warcraft_class_id'); ?>
		<?php echo $form->textField($model,'warcraft_class_id',array('size'=>10,'maxlength'=>10, 'class'=>'input-xxlarge'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50, 'class'=>'input-xxlarge'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'english_name'); ?>
		<?php echo $form->textField($model,'english_name',array('size'=>50,'maxlength'=>50, 'class'=>'input-xxlarge'))); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>