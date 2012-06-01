<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    		'name'=>'post_date_picker',
    		'options'=>array(
        		'showAnim'=>'fold',
    			'altField'=>'#Post_post_date',
    			'altFormat'=> "yy-mm-dd",        		
    			'showOn'=> 'button',
    		),
    		'htmlOptions'=>array(
        		'style'=>'height:20px;'
    		),
    		'value'=>Yii::app()->dateFormatter->formatDateTime($model->post_date, 'long', null),
    		'language'=>'ru',
		));	?>	
		<?php echo $form->hiddenField($model,'post_date'); ?>
		<?php echo $form->error($model,'post_date'); ?>

	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'blog_id'); ?>
		<?php 
			$blog_list = CHtml::listData(Blog::model()->findAccessableBlogs(), 'id', 'title');
			echo $form->dropDownList($model,'blog_id', $blog_list, array('empty'=>'Черновики')); ?>
		<?php echo $form->error($model,'blog_id'); ?>
	</div>	
	<?php if(!$model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'post_image'); ?>
		<?php if ($model->post_thumbnail) {?>   
			<a href="<?php echo $model->post_image; ?>" rel="lightbox" title="<?php echo $model->title; ?>">
				<div class="post_image">
    	    		<img src="<?php echo $model->post_thumbnail; ?>"/>
	        	</div>					
			</a>
		<?php } ?>

		<?php echo $form->fileField($model,'post_image'); ?>
		<?php echo $form->error($model,'post_image'); ?>
	</div>	
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>20, 'cols'=>50, 'class'=>'redactor')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->