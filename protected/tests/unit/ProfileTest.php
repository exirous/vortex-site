<?php
/**
 * User: Русинов Максим
 * Date: 06.06.12
 * Time: 13:38
 */
class ProfileTest extends CDbTestCase {

    public $fixtures = array(
        'profiles' => 'Profile',
        'ranks' => 'Rank',
        'characters' => 'Character',
    );

    public function testAdministatorHaveRoleAdministrator()
    {
        $profile_model = $this->profiles('admin');
        $this->assertEquals($profile_model->activeRole, 'administrator');
    }

    public function testMemberGuildHaveRoleMember()
    {
        $profile_model = $this->profiles('member');
        $this->assertEquals($profile_model->activeRole, 'member', 'Active Role: '.$profile_model->activeRole);
    }

    public function testNotMemberGuildHaveRoleFromProfile()
    {
        $profile_model = $this->profiles('not_member');
        $role_from_profile = $profile_model->role;
        $this->assertEquals($profile_model->activeRole, $role_from_profile, 'Active Role: '.$profile_model->activeRole);
    }
}