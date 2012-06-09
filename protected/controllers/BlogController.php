<?php

class BlogController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'update', 'addAuthor'),
				'roles'=>array('member'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$dataProvider = new CActiveDataProvider('Post', array(
			'criteria'=>array(
		        'condition'=>'blog_id='.$id,
		        'order'=>'post_date DESC, t.created DESC',
		        'with'=>'author'
		    ),
			'pagination'=>array(
            	'pageSize'=>5,
        	),
		));

		if(!Yii::app()->user->checkAccess('member') && !$model->is_public) {
			$dataProvider = null;
		}


		$this->render('view',array(
			'model' => $model,
			'dataProvider' => $dataProvider,
		));
	}

	public function actionCreate()
	{
		$model=new Blog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Blog']))
		{
			$model->attributes=$_POST['Blog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Blog']))
		{
			$model->attributes=$_POST['Blog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Blog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAddAuthor($id)
    {
        $form_model = new CharacterSelect();
        $blog = $this->loadModel($id);
        if (!Yii::app()->user->checkAccess('blog_owner', array('blog' => $blog))) {
            Yii::app()->user->setFlash('error', 'Нельзя добавлять авторов в чужой блог');
            $this->redirect(array('view','id'=>$blog->id));
        }

        if(isset($_POST['CharacterSelect']))
        {
            $form_model->setAttributes($_POST['CharacterSelect']);
            if($form_model->validate()) {
                if ($profile = $form_model->character->profile) {
                    if ($blog->isProfileRole($profile->id, 'blog_author', array('blog' => $blog))) {
                        Yii::app()->user->setFlash('error', 'Данный профиль уже присутствует в списке авторов этого блога');
                        $this->redirect(array('view','id'=>$blog->id));
                    } else {
                        $blog->setProfileRole($profile->id, 'blog_author');
                        Yii::app()->user->setFlash('success', $form_model->character->name." успешно добавлен(а) в авторы блога.");
                        $this->redirect(array('view','id'=>$blog->id));
                    }
                } else{
                    Yii::app()->user->setFlash('error', $form_model->character->name." не прикреплен к профилю сайта. Добавление в авторы невозможно");
                    $this->redirect(array('view','id'=>$blog->id));
                }
            }
        }
        $this->render('/forms/addCharacter', array(
            'model' => $form_model,
        ));
    }

	public function loadModel($id)
	{
		$model=Blog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
