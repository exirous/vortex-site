<?php
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'warcraft-class-spec-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'warcraft_class_id'); ?>
        <?php echo $form->dropDownList($model,'warcraft_class_id', CHtml::listData(WarcraftClass::model()->findAll(), "id", "name"), array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'warcraft_class_id'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'english_name'); ?>
		<?php echo $form->textField($model,'english_name',array('size'=>50,'maxlength'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'english_name'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->