<?php
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stream-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'owner_id'); ?>
		<?php echo $form->dropDownList($model,'owner_id', CHtml::listData(Profile::model()->findAll(), "id", "mainCharacter.name"), array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'owner_id'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', $model->types, array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

    <div>
        <?php echo $form->labelEx($model,'channel'); ?>
        <?php echo $form->textField($model,'channel',array('size'=>60,'maxlength'=>250, 'class'=>'input-xxlarge')); ?>
        <?php echo $form->error($model,'channel'); ?>
    </div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->