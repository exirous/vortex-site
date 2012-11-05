<?php
class WebUser extends CWebUser {
    private $model = null;
    private $enable_phpbb_auth = true;

    public function init() {
        parent::init();

        global $user;

        if ($this->getIsGuest() && $this->enable_phpbb_auth) {
            $identity = new UserIdentity($user->data['user_email'],$user->data['user_password']);
            if($identity->authinicateByPhpBB()) {
                $this->login($identity);
            }
        }

        $this->updateAuthStatus();
    }
 
    function getRole() {
        if($profile = $this->getProfile()){
            return $profile->getActiveRole();
        }
    }
 
    public function getProfile(){
        if (!$this->isGuest && $this->model === null){
            $this->model = Profile::model()->findByPk($this->profile_id);
        }
        return $this->model;
    }

    // Используется для получения ID записи в таблице профилей.
    public function getId() {
        if (isset($this->profile_id)) {
            return $this->profile_id;
        } else {
            return false;
        }
    }

    public function isProfileId($profile_id) {
        return (isset($this->profile_id) && ($this->profile_id == $profile_id));
    }

    public function afterLogout(){
        global $user, $config_phpbb, $config;
        $temp_config = $config;
        $config = $config_phpbb;
        ob_start();
        $user->session_kill();
        ob_end_clean();
        $config = $temp_config;
    }
}
?>