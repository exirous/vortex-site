<?php
/* @var $this RaidBossController */
/* @var $model RaidBoss */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'raid-boss-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'raid_id'); ?>
        <?php echo $form->dropDownList($model,'raid_id', CHtml::listData(Raid::model()->findAll(), "id", "name")); ?>
		<?php echo $form->error($model,'raid_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->TextArea($model,'description'); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'youtube_search'); ?>
        <?php echo $form->textField($model,'youtube_search',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'youtube_search'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'youtube_search_ru'); ?>
        <?php echo $form->textField($model,'youtube_search_ru',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'youtube_search_ru'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->