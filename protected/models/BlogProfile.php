<?php
/**
 * User: Русинов Максим
 * Date: 09.06.12
 * Time: 15:48
 */
class BlogProfile extends CFormModel {
    public $blog;
    public $profile;
    public $role = 'author';

    public function rules()
    {
        return array(
            array('characterName', 'required'),
            array('username', 'exist', 'className'=>'User'),
            array('username', 'verify'),
    );
}
