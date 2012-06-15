<?php
/**
* 
*/
class Comment extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'comments';
	}	

	public function relations()
	{
	    return array(	    	
	        'author' => array(self::BELONGS_TO, 'Profile', 'author_id'),
            'post'=>array(self::BELONGS_TO, 'Post', 'post_id'),	        
	    );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Комментарий',
			'author_id' => 'Автор',
			'post_id' => 'Пост',
			'created' => 'Создан',
			'updated' => 'Обновлен',
		);
	}

	public function rules()
	{
	    return array(
	        array('text', 'required'),
	    );
	}

    public function canEdit($user_id){
        return (($this->author_id == $user_id) && ($this->created > MySQL::timestampToMySqlString(time()-(30*60))));
    }

    public function canDelete($user_id){
        return Yii::app()->authManager->checkAccess;
    }

	protected function beforeSave()
	{
	    if(parent::beforeSave())
	    {
	        if($this->isNewRecord)
	        {
	            $this->created = $this->updated = new CDbExpression('NOW()');
				$this->author_id=Yii::app()->user->profile_id;	            
	        }
	        else
	            $this->updated = new CDbExpression('NOW()');
	        return true;
	    }
	    else
	        return false;
	}		
}
?>