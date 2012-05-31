<div class="comment">
   <div class="comment-info"> 
        <div class="comment-author_image left">
            <img width="30px" height="30px" src="http://eu.battle.net/static-render/eu/<?php echo $data->author->mainCharacter->thumbnail ?>" ></img>
        </div>
        <div class="comment-author left"><span class="<?php echo $data->author->mainCharacter->warcraftClass->english_name;?>"><?php echo $data->author->mainCharacter->name; ?><span></div>        
        <div class="comment-date left"><?php echo $data->created; ?></div>
        <div class="comment-actions right">
            <?php if (Yii::app()->user->isProfileId($data->author_id) || Yii::app()->user->checkAccess('administrator')) {
                echo CHtml::link('Удалить', '#', array('submit'=>array('comment/delete','id'=>$data->id), 'confirm'=>'Вы уверены, что хотите удалить комментарий?', 'class' => 'btn btn-danger'));
            } ?>
        </div>        
        <div class="clear"></div>
    </div>
  
    <div class="comment-text"><?php echo $data->text ?></div>
</div>