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
				'actions'=>array('delete', 'edit'),
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
            if (Yii::app()->user->checkAccess('comment_delete')) {
				$comment->delete();
			} else {
            	Yii::app()->user->setFlash('error', "Вы не можете удалить данный комментарий");
			}

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('post/view', 'id' => $post_id));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    public function actionEdit() {

        $model = $this->loadModel();

        if (!Yii::app()->user->checkAccess('comment_edit')) {
            throw new CHttpException(400,'Нельзя редактирировать данный комментарий.');
        }

        if(isset($_POST['Comment']))
        {
            $model->attributes=$_POST['Comment'];
            if ($model->save()) {
                $this->redirect(array('post/view', 'id' => $model->post_id));
            }
        }

        if(isset($_GET['ajax'])) {
            $this->renderPartial('/comment/_form', array('model' => $model));
        } else {
            $this->render('/comment/edit', array('model' => $model));
        }

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