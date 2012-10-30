<?php

class WarcraftClassSpecController extends Controller
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'roles'=>array('administrator'),
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new WarcraftClassSpec;

		if(isset($_POST['WarcraftClassSpec']))
		{
			$model->attributes=$_POST['WarcraftClassSpec'];
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

		if(isset($_POST['WarcraftClassSpec']))
		{
			$model->attributes=$_POST['WarcraftClassSpec'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('WarcraftClassSpec');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new WarcraftClassSpec('search');
		$model->unsetAttributes();
		if(isset($_GET['WarcraftClassSpec']))
			$model->attributes=$_GET['WarcraftClassSpec'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=WarcraftClassSpec::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='warcraft-class-spec-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
