<?php
class GuildController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl'
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
				'actions'=>array(),
				'users'=>array('@'),
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
			'characters'=>Guild::model()->getCharacters($id)
		));
	}

	public function loadModel($id)
	{
		$model=Guild::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Данная страница отсутствует.');
		return $model;
	}

}

?>