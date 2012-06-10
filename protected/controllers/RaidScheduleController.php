<?php
/**
 * User: Русинов Максим
 * Date: 10.06.12
 * Time: 16:31
 */
class RaidScheduleController extends Controller
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
                'actions'=>array('generate'),
                'roles'=>array('administrator'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionGenerate(){
        $raid_schedules = RaidSchedule::model()->findAll();
        foreach ($raid_schedules as $raid_schedule) {
            $raid_schedule->generateRaidEvents(time());
            $raid_schedule->generateRaidEvents(time()+7*24*60*60);
            $raid_schedule->generateRaidEvents(time()+14*24*60*60);
            $raid_schedule->generateRaidEvents(time()+21*24*60*60);
        }

        Yii::app()->user->setFlash('success', 'Удачно обработано расписание рейдов');
        $this->redirect('/');
    }

}
