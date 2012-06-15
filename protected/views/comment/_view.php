<div class="comment commentId<?php echo $data->id; ?>">
   <div class="comment-info"> 
        <div class="comment-author_image left">
            <img width="30px" height="30px" src="http://eu.battle.net/static-render/eu/<?php echo $data->author->mainCharacter->thumbnail ?>" ></img>
        </div>
        <div class="comment-author left"><span class="<?php echo $data->author->mainCharacter->warcraftClass->english_name;?>"><?php echo $data->author->mainCharacter->name; ?><span></div>        
        <div class="comment-date left"><?php echo Yii::app()->dateFormatter->formatDateTime($data->created, 'full', 'short'); ?></div>
        <div class="actions right">
            <?php
            if (Yii::app()->user->checkAccess('comment_edit', array('comment' => $data))) {
                    echo CHtml::ajaxLink('Редактировать', array('comment/edit', 'id' => $data->id, 'ajax' => 'ajax'),
                        array('success' => 'js:function(html){jQuery(".commentId'.$data->id.'").html(html); jQuery(".commentId'.$data->id.' .redactor-comment").redactor({ lang: "ru",  toolbar: "mini", autoformat: "false", autoresize: "true", focus: true });}'),
                        array('class' => 'btn btn-warning'));
                }
                echo '&nbsp';

                if (Yii::app()->user->checkAccess('comment_delete')) {
                    echo CHtml::link('Удалить', '#', array('submit'=>array('comment/delete','id'=>$data->id), 'confirm'=>'Вы уверены, что хотите удалить комментарий?', 'class' => 'btn btn-danger'));
                }
            ?>
        </div>        
        <div class="clear"></div>
    </div>
  
    <div class="comment-text"><?php echo MyHtml::myFormatText($data->text); ?></div>
    <div class="clear"></div>
</div>