<div class='box_content'>
	<h2>Редактировать профиль</h2>

	<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
	<?php echo CHtml::activelabel($model,'realname'); ?>
	<?php echo CHtml::activetextField($model,'realname'); ?>
	</div>

	<div class="row">
	<?php echo CHtml::activelabel($model,'phone'); ?>
	<?php echo CHtml::activetextField($model, 'phone'); ?>
	</div>

	<div class="row">
	<?php echo CHtml::activelabel($model,'place'); ?>
	<?php echo CHtml::activetextField($model, 'place'); ?>
	</div>
	 
	<div class="row submit">
	<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>
	 
	<?php echo CHtml::endForm(); ?>

</div><!-- form -->