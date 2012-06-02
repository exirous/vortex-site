<?php
$this->breadcrumbs=array(
    CHtml::encode($model->title),
);
?>

<div class="post">
    <h2>
        <?php echo CHtml::link(CHtml::encode($model->title), array('post/view', 'id'=>$model->id)); ?>
    </h2>  

    <div class="post-text"><?php echo MyHtml::myFormatText($model->text); ?></div>
    <?php if ($model->post_thumbnail) {?>   
        <a href="<?php echo $model->post_image; ?>" rel="lightbox" title="<?php echo $model->title; ?>">
            <div class="post-image">
                <img src="<?php echo $model->post_thumbnail; ?>"/>
            </div>                  
        </a>
    <?php } elseif ($model->post_image) {?>    
        <div class="post-image">
            <img src="<?php echo $model->post_image; ?>"/>
        </div>
    <?php } ?>
    <div class="post-info"> 
        <div class="post-author_image left">
            <img width="30px" height="30px" src="http://eu.battle.net/static-render/eu/<?php echo $model->author->mainCharacter->thumbnail?>" ></img>
        </div>
        <div class="post-author left"><span class="<?php echo $model->author->mainCharacter->warcraftClass->english_name;?>"><?php echo $model->author->mainCharacter->name; ?><span></div>        
        <div class="post-date left"><?php echo Yii::app()->dateFormatter->formatDateTime($model->post_date, 'full', null); ?></div>
        <div class="actions right">
            <?php if (Yii::app()->user->isProfileId($model->author_id)) {
                echo CHtml::link('Редактировать', array('post/update', 'id'=>$model->id), array('class' => 'btn btn-primary'));
                echo '&nbsp';
                echo CHtml::link('Удалить', '#', array('submit'=>array('delete','id'=>$model->id), 'confirm'=>'Вы уверены, что хотите удалить данную запись?', 'class' => 'btn btn-danger'));
            } ?>
        </div>
        <div class="clear"></div>
    </div>
    
</div>
<hr/>
<div class="post-comments">
    <a name="comments"></a>
    <h3>Комментарии</h3>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$commentsProvider,
        'itemView'=>'/comment/_view',   
        'template'=>"{items}",
    )); ?>
    <?php if (Yii::app()->user->id) { ?>
    <h3>Оставить комментарий</h3>
 
    <?php $this->renderPartial('/comment/_form', array(
        'model'=>$comment,
    )); ?>
    <?php } ?>
 
</div> 