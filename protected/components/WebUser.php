<?php
class WebUser extends CWebUser {
    private $model = null;
 
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
}
?>