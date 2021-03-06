<?php

class PostController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update', 'index'),
				'roles'=>array('member'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate($blog_id = 0)
	{
		$model = new Post;
		$model->blog_id = $blog_id;

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_image=CUploadedFile::getInstance($model,'post_image');
			if ($model->post_image) {
				$extensionName = $model->post_image->getExtensionName();
				$image_file = Yii::app()->basePath.'/../media/post/'.$model->id.'.'.$extensionName;
				$model->post_image->saveAs($image_file);
				$img = Yii::app()->simpleImage->load($image_file);
				$img->resizeToWidth(450);
				$img->save(Yii::app()->basePath.'/../media/post/thumbnail/'.$model->id.'.'.$extensionName);
				$model->post_image='/media/post/'.$model->id.'.'.$extensionName;
				$model->post_thumbnail='/media/post/thumbnail/'.$model->id.'.'.$extensionName;
			}

			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old_image = $model->post_image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->post_image=CUploadedFile::getInstance($model,'post_image');
			if ($model->post_image) {
				$extensionName = $model->post_image->getExtensionName();
				$image_file = Yii::app()->basePath.'/../media/post/'.$model->id.'.'.$extensionName;
				$model->post_image->saveAs($image_file);
				$img = Yii::app()->simpleImage->load($image_file);
				$img->resizeToWidth(450);
				$img->save(Yii::app()->basePath.'/../media/post/thumbnail/'.$model->id.'.'.$extensionName);
				$model->post_image='/media/post/'.$model->id.'.'.$extensionName;
				$model->post_thumbnail='/media/post/thumbnail/'.$model->id.'.'.$extensionName;				
			} else {
				$model->post_image = $old_image;
			}
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->breadcrumbs = array('Мои статьи');
		$dataProvider=new CActiveDataProvider('Post', array(
			'criteria'=>array(
		        'condition'=>'author_id='.Yii::app()->user->profile_id,
		        'order'=>'post_date DESC',
		        'with'=>'blog')		
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,	
		));
	}

	public function actionView()
	{
	    $post = $this->loadModel();
    	$comment = $post->newComment($this);
		$commentsProvider = $post->getCommentsProvider();

	    $this->render('view', array(
	        'model' => $post,
        	'comment' => $comment,
        	'commentsProvider' => $commentsProvider,	        
	    ));
	}
	 
	public function loadModel()
	{
	    if($this->_model===null)
	    {
	        if(isset($_GET['id']))
	        {
	            $this->_model = Post::model()->findByPk($_GET['id']);
	        }
	        if($this->_model===null)
	            throw new CHttpException(404,'Запрашиваемая страница не существует.');
	    }
	    return $this->_model;
	}	

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
