<?php
class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            return $user->role;
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Profile::model()->findByPk($this->profile_id, array('select' => 'role'));
        }
        return $this->_model;
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