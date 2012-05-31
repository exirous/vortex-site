<?php

class CommentController extends Controller
{

	public $layout='//layouts/column2';
	private $_model;	

	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('delete'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$comment = $this->loadModel($id);
			$post_id = $comment->post_id;

			if (Yii::app()->user->isProfileId($comment->author_id)) {
				$comment->delete();
			} else {
            	Yii::app()->user->setFlash('error', "Нельзя удалить чужой комментарий");				
			}

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('post/view', 'id' => $post_id));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}	

	public function loadModel()
	{
	    if($this->_model===null)
	    {
	        if(isset($_GET['id']))
	        {
	            $this->_model = Comment::model()->findByPk($_GET['id']);
	        }
	        if($this->_model===null)
	            throw new CHttpException(404,'Запрашиваемая страница не существует.');
	    }
	    return $this->_model;
	}		
}

?>