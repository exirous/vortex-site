<?php
/**
 * User: RusMaxim
 * Date: 23.09.12
 * Time: 4:38
 */
class CommentBehavior extends CActiveRecordBehavior{
    public $modelClassName;

    public function attach($owner)
    {
        parent::attach($owner);
        $this->getOwner()->getMetaData()->addRelation('comments', array(CActiveRecord::BELONGS_TO, 'Comment', 'parent_id',
            'on'=>'comments.modelClassName="'.$this->modelClassName.'"'));
        $this->getOwner()->getMetaData()->addRelation('commentCount', array(CActiveRecord::STAT, 'Comment', 'parent_id',
            'condition'=>'modelClassName="'.$this->modelClassName.'"'));
    }

    public function getCommentsProvider() {
        return new CActiveDataProvider('Comment',
            array(
    			'criteria'=>array(
	    	        'condition'=>'modelClassName="'.$this->modelClassName.'" AND parent_id='.$this->owner->id,
		            'order'=>'created ASC'
                ),
                'pagination'=>array(
                    'pageSize'=>100,
                ),
		    )
        );
    }

    public function addComment($comment)
    {
        $comment->modelClassName = $this->modelClassName;
        $comment->parent_id = $this->owner->id;
        return $comment->save();
    }

    protected function newComment($controller)
    {
        $comment=new Comment;
        if(isset($_POST['Comment']))
        {
            $comment->attributes=$_POST['Comment'];
            if($this->owner->addComment($comment))
            {
                $controller->refresh();
            }
        }
        return $comment;
    }
}
