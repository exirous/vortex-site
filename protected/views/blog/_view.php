<div class="blog">
    <div class="actions right">
    <?php if (Yii::app()->user->isProfileId($data->owner_id)  || Yii::app()->user->checkAccess('administrator')) {
        echo CHtml::link('Редактировать', array('blog/update', 'id'=>$data->id), array('class' => 'btn btn-primary'));
        echo '&nbsp';
        echo CHtml::link('Удалить', '#', array('submit'=>array('blog/delete','id'=>$data->id), 'confirm'=>'Вы уверены, что хотите удалить данную запись?', 'class' => 'btn btn-danger'));
    } ?>
	</div>	
	<h3><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
        <?php if ($data->is_public) {?> <span class="label label-info">Публичный блог</span> <?php } ?>
    </h3> 
	<?php echo MyHtml::characterSpan($data->owner->mainCharacter)." / ";
        foreach ($data->authors as $profile) {
            echo MyHtml::characterSpan($profile->mainCharacter)." / ";
        } ?>
	Создан: <?php echo Yii::app()->dateFormatter->formatDateTime($data->created, 'full', null); ?>
    <div class="clear"></div>	
</div>