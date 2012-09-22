<?php

class Post extends CActiveRecord
{

	public $default_blog = "Черновики";

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'posts';
	}

    public function behaviors(){
        return array(
            'CommentBehavior' => array(
                'class' => 'application.components.behaviors.CommentBehavior',
                'modelClassName' => 'Post',
            )
        );
    }

	public function rules()
	{
		return array(
			array('title, text', 'required'),
			array('post_date', 'safe'),
			array('title, post_image', 'length', 'max'=>200),
			array('blog_id, author_id', 'length', 'max'=>10),
			array('post_image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true),
			array('id, title, blog_id, author_id, text, post_date, post_image, created, updated', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
	    return array(
	        'author' => array(self::BELONGS_TO, 'Profile', 'author_id'),
	        'blog' => array(self::BELONGS_TO, 'Blog', 'blog_id'),
	    );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'blog_id' => 'Блог',
			'author_id' => 'Автор',
			'text' => 'Содержание',
			'post_date' => 'Дата',
			'post_image' => 'Изображение',
			'created' => 'Создан',
			'updated' => 'Обновлен',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('blog_id',$this->blog_id,true);
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('post_date',$this->post_date,true);
		$criteria->compare('post_image',$this->post_image,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getThumbnail() {
		return str_replace ( '/post' , '/post/thumbnail' , $this->post_image);
	}

	protected function beforeSave()
	{
	    if(parent::beforeSave())
	    {
	        if($this->isNewRecord)
	        {
	            $this->post_date=$this->created=$this->updated=new CDbExpression('NOW()');
	            $this->author_id=Yii::app()->user->profile_id;
	        }
	        else
	            $this->post_date=$this->updated=new CDbExpression('NOW()');
	        return true;
	    }
	    else
	        return false;
	}		

	public function getBlogTitle() {
		return ($this->blog_id) ? $this->blog->title : $this->default_blog;
	}
}