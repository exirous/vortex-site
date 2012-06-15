<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
	),
)); ?>

<fieldset>
	<div class="control-group">
		<?php echo $form->textArea($model, 'text', array('rows'=>5, 'cols'=>50, 'class'=>'redactor-comment')); ?>
	</div>
</fieldset>

<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => 'btn btn-primary right')); ?>

<?php $this->endWidget(); ?>
    <div class="clear"></div>
</div>