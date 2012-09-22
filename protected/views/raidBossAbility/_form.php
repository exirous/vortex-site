<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'raid-boss-ability-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения..</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>120,'maxlength'=>255, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>100, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <div>
        <?php echo $form->labelEx($model,'raid_boss_id'); ?>
        <?php echo $form->dropDownList($model,'raid_boss_id', CHtml::listData(RaidBoss::model()->findAll(), "id", "name"),
            array(
                'class'=>'input-xxlarge',
                'empty' => "Не задан",
                'ajax' => array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('raidBossAbility/getAbilities'),
                    'update'=>'#RaidBossAbility_parent_id',
                ),
            )); ?>
        <?php echo $form->error($model,'raid_boss_id'); ?>
    </div>

    CHtml::listData(RaidBossAbility::model()->findAll(), "id", "name")
	<div>
		<?php echo $form->labelEx($model,'parent_id'); ?>
        <?php echo $form->dropDownList($model,'parent_id', array(), array('empty' => "Не задан", 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->