<?php

class WowapiController extends Controller
{

    public $layout='//layouts/column2';

    public function actionRealmsLoad () {
        if (Yii::app()->wowapi->RealmsLoad()) {
            Yii::app()->user->setFlash('success', "Список игровых миров загружен");
            $this->render('simple');
        }
    }

    public function actionGuildLoad ($guild_name = 'Вортекс', $realm = 'Черный-Шрам') {
        if (Yii::app()->wowapi->GuildLoad($guild_name, $realm)) {
            Yii::app()->user->setFlash('success', "Гильдия ".$guild_name." (".$realm.") загружена.");
            $this->render('simple');
        }
    }

    protected function beforeAction($action) {
        return true;
    }
}

?>