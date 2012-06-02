
<?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'blog-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php $input = $form->textField($model, 'title', array('size'=>60,'maxlength'=>200)); 
  	echo $form->inputWithLabelAndError($model, 'title', $input); ?>

		
  	<?php 
  	if(Yii::app()->user->checkAccess('administrator')) {
  		$input = $form->checkBox($model, 'is_public');
  		echo $form->inputWithLabelAndError($model, 'is_public', $input);
  	}
  	?>

 	<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => 'btn btn-primary')); ?>

<?php $this->endWidget(); ?>
