<?php
/**
 * User: Русинов Максим
 * Date: 09.06.12
 * Time: 13:41
 */
class BlogTest extends CDbTestCase {
    public $fixtures = array(
        'blogs' => 'Blog',
        'profiles' => 'Profile',
        'ranks' => 'Rank',
        'characters' => 'Character',
        'blogRole'=>':blog_profile_role',
    );

    public function testSetProfileToRole() {
        $blog = $this->blogs('blog_1');
        $profileId = 115;
        $role = 'blog_author';
        $this->assertTrue($blog->setProfileRole($profileId, $role), "Cannot set profile to role");
        $this->assertTrue($blog->isProfileRole($profileId, $role), "Profile not assigned to role");
    }

    public function testRemoveProfileRole() {
        $blog = $this->blogs('blog_1');
        $profileId = 115;
        $role = 'blog_author';
        $this->assertTrue($blog->setProfileRole($profileId, $role), "Cannot set profile to role");
        $this->assertTrue($blog->removeProfileRole($profileId, $role), "Cannot remove profile to role");
        $this->assertFalse($blog->isProfileRole($profileId, $role), "Profile not assigned to role");
    }

    public function testProfileAccessOnBlogProfileRules() {
        $blog = $this->blogs('blog_1');
        $profile_member_not_owning_blog = $this->profiles('member');
        $profile_member_owning_blog = $this->profiles('admin');

        $auth = Yii::app()->authManager;
        $auth->assign('member',$profile_member_not_owning_blog->id);
        $auth->assign('administrator',$profile_member_owning_blog->id);

        $this->assertTrue($auth->checkAccess('member', $profile_member_not_owning_blog->id));
        $this->assertTrue($auth->checkAccess('member', $profile_member_owning_blog->id));

        $role = 'blog_create_post';
        $this->assertTrue($auth->checkAccess('blog_owner', $profile_member_owning_blog->id, array('blog' => $blog)));
        $this->assertFalse($auth->checkAccess($role, $profile_member_not_owning_blog->id, array('blog' => $blog)));

        $blog->setProfileRole($profile_member_not_owning_blog->id, 'blog_author');
        $this->assertTrue($blog->isProfileRole($profile_member_not_owning_blog->id, 'blog_author'), "Profile not assigned to role");

        $this->assertTrue($auth->checkAccess($role, $profile_member_owning_blog->id, array('blog' => $blog)));
        $this->assertTrue($auth->checkAccess($role, $profile_member_not_owning_blog->id, array('blog' => $blog)));

    }

}
