<?php
/**
 * User: Русинов Максим
 * Date: 13.06.12
 * Time: 17:36
 */
class RaidEventController extends Controller {

    public $layout='//layouts/column2';
    private $_model;

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
                'actions'=>array('view'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('setRaidParticipationStateNormal','setRaidParticipationStateNo', 'setRaidParticipationStateLate'),
                'roles'=>array('member'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionView()
    {
        $raid_event = $this->loadModel();
        $participants = $raid_event->getParticipants();
        $data_provider = new CArrayDataProvider($participants,array(
                'pagination'=>false,
                'sort'=>array(
                    'attributes'=>array(
                        'rank'=>array(
                            'asc'=>'character.rank.api_id ASC',
                            'desc'=>'character.rank.api_id DESC',
                            'label'=>'Ранг',
                            'default'=>'asc',
                        ),
                    ),
                    'defaultOrder'=>array(
                        'rank'=>CSort::SORT_ASC,
                    )
                ),
            ));

        $this->render('view', array(
            'model' => $raid_event,
            'participants' => $data_provider,
        ));
    }

    public function actionSetRaidParticipationStateNormal () {
        $raid_event = $this->loadModel();
        $profile = Yii::app()->user->profile;
        if ($profile && !$raid_event->is_fixed && $profile->mainCharacter) {
            $raid_event->setCharacterState($profile->mainCharacter, RaidEvent::RAID_PARTICIPATION_NORMAL);
        }
        $this->redirect(array('raidEvent/view', 'id' => $raid_event->id));
    }

    public function actionSetRaidParticipationStateNo () {
        $raid_event = $this->loadModel();
        $profile = Yii::app()->user->profile;
        if ($profile && !$raid_event->is_fixed && $profile->mainCharacter) {
            $raid_event->setCharacterState($profile->mainCharacter, RaidEvent::RAID_PARTICIPATION_NO);
        }
        $this->redirect(array('raidEvent/view', 'id' => $raid_event->id));
    }

    public function actionSetRaidParticipationStateLate () {
        $raid_event = $this->loadModel();
        $profile = Yii::app()->user->profile;
        if ($profile && !$raid_event->is_fixed && $profile->mainCharacter) {
            $raid_event->setCharacterState($profile->mainCharacter, RaidEvent::RAID_PARTICIPATION_LATE);
        }
        $this->redirect(array('raidEvent/view', 'id' => $raid_event->id));
    }

    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
            {
                $this->_model = RaidEvent::model()->findByPk($_GET['id']);
            }
            if($this->_model===null)
                throw new CHttpException(404,'Запрашиваемая страница не существует.');
        }
        return $this->_model;
    }
}
