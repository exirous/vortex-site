<?php

class RaidBossAbilityController extends Controller
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
			array('allow', //
				'actions'=>array('admin','delete','getAbilities'),
				'roles'=>array('administrator'),
			),
			array('deny',
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
		$model=new RaidBossAbility;

		if(isset($_POST['RaidBossAbility']))
		{
			$model->attributes=$_POST['RaidBossAbility'];
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

		if(isset($_POST['RaidBossAbility']))
		{
			$model->attributes=$_POST['RaidBossAbility'];
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
		$dataProvider=new CActiveDataProvider('RaidBossAbility');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new RaidBossAbility('search');
		$model->unsetAttributes();
		if(isset($_GET['RaidBossAbility']))
			$model->attributes=$_GET['RaidBossAbility'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=RaidBossAbility::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='raid-boss-ability-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionGetAbilities()
    {
        $data=RaidBossAbility::model()->findAll('raid_boss_id=:raid_boss_id',
            array(':raid_boss_id'=>(int) $_POST['RaidBossAbility']['raid_boss_id']));

        $data=CHtml::listData($data,'id','name');

        echo '<option value="">Не задан</option>)';
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                array('value'=>$value),CHtml::encode($name),true);
        }
    }
}
