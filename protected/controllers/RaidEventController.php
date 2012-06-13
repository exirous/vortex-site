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
