
<?php 
Yii::import('application.vendors.*');
require_once('TeamSpeak3/TeamSpeak3.php');
 
class TeamSpeak extends CApplicationComponent
{

	
	public $ts3Server;
    public $server_ip = '92.39.131.37';
    public $server_port = '9987';
    public $connectionString = 'serverquery://rusmaxim:ROqtf2of@92.39.131.37:10011/?server_port=9987';

    public function init()
    {
    	parent::init();

        try {
            Yii::registerAutoloader (array('TeamSpeak3', 'autoload'));
	   	    $this->ts3Server = TeamSpeak3::factory($this->connectionString);
        } catch (TeamSpeak3_Adapter_ServerQuery_Exception $e) {
            $this->ts3Server = false;
        }
    }

    public function clientList()
    {
    	return $this->ts3Server->clientList();
    } 

    public function clientListDb()
    {
    	return $this->ts3Server->clientListDb();
    }     

    public function onlineList($showEmptyChannels)
    {
        $channels = $this->ts3Server->channelList();

        return $channels;
    }

    public function maintance()
    {
    	$warcraftClasses = WarcraftClass::model()->findAll();
    	foreach ($warcraftClasses as $warcraftClass) {
    		try {
    			$serverGroup = $this->ts3Server->serverGroupGetByName($warcraftClass->name);
    		} catch (TeamSpeak3_Adapter_ServerQuery_Exception $e) {
    			$serverGroupId = $this->ts3Server->serverGroupCreate($warcraftClass->name);
    			$serverGroup = $this->ts3Server->serverGroupGetById($serverGroupId);
    		}
    	}

    	foreach ($this->ts3Server->clientListDb() as $client_id => $client ) { 
    		$clint_nickname = $client['client_nickname'];

    		$character = Character::model()->findByName($clint_nickname);

    		if ($character) {
    			$serverGroupName = $character->warcraftClass->name;
    			try {
    				$this->ts3Server->serverGroupClientAdd($this->getServerGroupIdByName($serverGroupName), $client_id);
    			} catch (TeamSpeak3_Adapter_ServerQuery_Exception $e) {
    			}

    		}
    	}
    }

    public function checkToken($token) 
    {
        if (!$token) return false;
        try {
            $tokenList = array_keys($this->ts3Server->tokenList());
        } catch (TeamSpeak3_Adapter_ServerQuery_Exception $e) {
            return false;
        }
        return in_array($token, $tokenList);
    }

    public function generateNormalToken($forName = "")
    {
        $token = $this->ts3Server->tokenCreate(0, $this->getServerGroupIdByName('Пользователь'), 0, 'Пользователь: '.$forName);
        return $token;
    }

    public function generateAdminToken($forName = "")
    {
        $token = $this->ts3Server->tokenCreate(0, $this->getServerGroupIdByName('Администратор'), 0, 'Администратор: '.$forName);
        return $token;
    }

    private function getServerGroupIdByName($name)
    {
        $serverGroup = $this->ts3Server->serverGroupGetByName($name);
        return  $serverGroup->getId();
    }
 
}

?>