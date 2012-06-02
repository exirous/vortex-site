<?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php $input = $form->textField($model, 'title', array('size'=>60,'maxlength'=>200)); 
  	echo $form->inputWithLabelAndError($model, 'title', $input); ?>

	<?php if(!$model->isNewRecord && $model->blog->is_public) { ?>
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
	<?php } ?>

  	<?php if(Yii::app()->user->checkAccess('administrator')) { ?>
		<?php echo $form->labelEx($model,'blog_id'); ?>
		<?php 
			$blog_list = CHtml::listData(Blog::model()->findAccessableBlogs(), 'id', 'title');
			echo $form->dropDownList($model,'blog_id', $blog_list, array('empty'=>'Черновики')); ?>
		<?php echo $form->error($model,'blog_id'); ?>	
	<?php } ?>

	<?php if(!$model->isNewRecord) { ?>
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
	<?php } ?>
	
	<fieldset>
	<?php echo $form->labelEx($model,'text'); ?>
	<?php echo $form->textArea($model,'text',array('rows'=>20, 'cols'=>50, 'class'=>'redactor')); ?>
	<?php echo $form->error($model,'text'); ?>
	</fieldset>

 	<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => 'btn btn-primary')); ?>

<?php $this->endWidget(); ?>