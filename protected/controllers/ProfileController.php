<?php
class ProfileController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl'
		);
	}

	public function actionView() {
		if (Yii::app()->user->isGuest) {
			Yii::app()->user->setFlash('error', "Необходимо авторизоваться");
			$this->redirect(array('site/login'));
		} else {
			$profile_id = Yii::app()->user->getState('profile_id');
			$profile = Profile::model()->findByPk($profile_id);
			if (Yii::app()->ts3->ts3Server) {
				foreach ($profile->characters as $character) {
					$character->generateTs3Tokens();
				}
			}

			$this->render('view', array(
				'profile' => $profile,
				'username' => Yii::app()->user->name,
			));
		}
	}

	public function actionEdit() {
		if (Yii::app()->user->isGuest) {
			Yii::app()->user->setFlash('error', "Необходимо авторизоваться");
			$this->redirect(array('site/login'));
		} else {;
			$profile_id = Yii::app()->user->getState('profile_id');
			$profile = Profile::model()->findByPk($profile_id);

			if(isset($_POST['Profile']))
			{
				$profile->attributes=$_POST['Profile'];
				if($profile->save())
					$this->redirect(array('view'));
			}

			$this->render('edit',array(
				'model'=>$profile,
			));	
		}		
	}

	public function actionList() {
		if(Yii::app()->user->checkAccess('administrator')){
			$profiles = Profile::model()->findAll();

			$this->render('list',array(
				'profiles'=>$profiles,
			));	
		} else {
			$this->redirect(array('site/index'));
		}
	}	

	public function actionAddCharacter() {
		$model = new CharacterSelect;
		$profile_id = Yii::app()->user->getState('profile_id');	

		if(isset($_POST['CharacterSelect']))
		{
			$model->setAttributes($_POST['CharacterSelect'], false);
			if($model->validate()) {
				if ($model->step == 1) {
					$model->selectItemsForConfirm();
					$model->step = 2;
				} elseif ($model->step == 2) {
					if ($model->checkItems()) {
						$model->character->setAttribute('profile_id', $profile_id);
						$model->character->save();
						$this->redirect(array('view'));
					}
				}
			}
		}
	
		$this->render('/forms/addCharacter', array(
			'model' => $model,
		));		
	}

	public function actionDeleteCharacter($id) {
		$character = Character::model()->findByPk($id);
		$profile_id = Yii::app()->user->getState('profile_id');
		
		if ($character) {
			if ($character->profile_id == $profile_id) {
				$character->setAttribute('profile_id', null);
				$character->save();
			} else {
				Yii::app()->user->setFlash('error', "Нельзя удалять чужого персонажа");
			}
		} else {
			Yii::app()->user->setFlash('error', "Персонаж не найден");
		}

		$this->redirect(array('view'));
	}

	public function actionSetMainCharacter($id) {
		$character = Character::model()->findByPk($id);
		$profile_id = Yii::app()->user->getState('profile_id');
		$profile = Profile::model()->findByPk($profile_id);
		
		if ($character) {
			if ($character->profile_id == $profile_id) {
				foreach ($profile->characters as $ownCharacter) {
					$ownCharacter->setAttribute('main_character', false);
					$ownCharacter->save();
				}
				$character->setAttribute('main_character', true);
				$character->save();
			} else {
				Yii::app()->user->setFlash('error', "Нельзя использовать чужого персонажа");
			}
		} else {
			Yii::app()->user->setFlash('error', "Персонаж не найден");
		}

		$this->redirect(array('view'));		
	}
}