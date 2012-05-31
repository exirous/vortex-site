<div class="post">

    <h2>
        <?php echo CHtml::link(CHtml::encode($data->title), array('post/view', 'id'=>$data->id)); ?>
    </h2>  

    <div class="post-text"><?php echo $data->text ?></div>
    <?php if ($data->post_image) {?>    
        <div class="post-image">
            <img src="<?php echo $data->post_image; ?>"/>
        </div>
    <?php } ?>
    <div class="post-info"> 
        <div class="post-author_image left">
            <img width="30px" height="30px" src="http://eu.battle.net/static-render/eu/<?php echo $data->author->mainCharacter->thumbnail?>" ></img>
        </div>
        <div class="post-author left"><span class="<?php echo $data->author->mainCharacter->warcraftClass->english_name;?>"><?php echo $data->author->mainCharacter->name; ?><span></div>        
        <div class="post-date left"><?php echo $data->post_date; ?></div>
        <?php if($data->commentCount>=1): ?>
        <div class="post-comment-count left">
            <?php echo CHtml::link('Комментарии: ' . $data->commentCount, array('post/view', 'id'=>$data->id, '#'=>'comments')); ?>
        </div>
        <?php endif; ?>        
        <div class="post-actions right">
            <?php if ($data->author_id == Yii::app()->user->profile_id) {
                echo CHtml::link('Редактировать', array('post/update', 'id'=>$data->id), array('class' => 'btn btn-primary'));
                echo '&nbsp';
                echo CHtml::link('Удалить', '#', array('submit'=>array('delete','id'=>$data->id), 'confirm'=>'Вы уверены, что хотите удалить данную запись?', 'class' => 'btn btn-danger'));
            } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>