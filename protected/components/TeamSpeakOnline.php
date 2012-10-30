
<?php Yii::import('zii.widgets.CPortlet');
 
class TeamSpeakOnline extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
    	$ts3 = Yii::app()->ts3;
        if($ts3) {
    	    $channels_clients = $ts3->ts3Server ? $ts3->onlineList(false) : false;

            $this->render('ts_online',array('onlineList'=>$channels_clients));
        }
    }
}

?>