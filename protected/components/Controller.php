<?php
class Controller extends CController
{
	public $layout='//layouts/column1';

	public $menu=array();
	public $operationMenu=array();
	public $profileMenu=array();
	public $blogMenu=array();

	public $breadcrumbs=array();

    public function init() {
        if(Yii::app()->user->checkAccess('administrator')){
            $this->operationMenu[] = array('label'=>'Загрузить список игровых миров', 'url'=>array('wowapi/RealmsLoad'));
            $this->operationMenu[] = array('label'=>'Загрузить гильдию Вортекс', 'url'=>array('wowapi/GuildLoad'));
            $this->operationMenu[] = array('label'=>'Обработать TeamSpeak3', 'url'=>array('site/TeamSpeakMaintance'));
            $this->operationMenu[] = array('label'=>'Заполнить список рейдов', 'url'=>array('raidSchedule/generate'));
            $this->operationMenu[] = array('label'=>'Список профилей', 'url'=>array('profile/list'));
        }
        return parent::init();
    }
}