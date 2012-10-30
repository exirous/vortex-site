<?php

class CharacterController extends Controller
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
                'actions'=>array('changeSpec'),
                'roles'=>array('administrator'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

	public function actionChangeSpec($id)
	{
        $model = $this->loadModel($id);
        if(isset($_POST['Character']))
        {
            $model->saveAttributes($_POST['Character']);
        }

		$this->renderPartial('roster',array(
            'data'=>$model,
        ));
	}

    public function loadModel($id)
    {
        $model=Character::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'Данная страница отсутствует.');
        return $model;
    }
}