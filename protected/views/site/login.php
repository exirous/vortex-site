<?php
$this->pageTitle='Авторизация';
?>

<h2>Авторизация</h2>

<div class='box_content'>

<p>Пожалуйста, представтесь:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'htmlOptions'=>array(
		'class'=>'nice',
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<div class='form-field error'>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('class'=>'large input_text')); ?>
		<small><?php echo $form->error($model,'email'); ?></small>
	</div>

	<div class='form-field error'>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'large input_text')); ?>
		<small><?php echo $form->error($model,'password'); ?></small>
	</div>

	<div class="form-field error'">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<small><?php echo $form->error($model,'rememberMe'); ?></small>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Войти', array('class'=>'nice small radius white button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

</div>