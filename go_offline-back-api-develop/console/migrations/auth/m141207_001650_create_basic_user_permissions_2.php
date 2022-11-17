<?php

use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use yii\db\Migration;

class m141207_001650_create_basic_user_permissions_2 extends Migration
{
	public function safeUp()
	{
        $group2 = new AuthItemGroup();

        $group2->code = 'userManagement';
		Permission::create('viewRegistrationIp', 'View registration IP', $group2->code);
		Permission::create('viewUserEmail', 'View user email', $group2->code);
		Permission::create('editUserEmail', 'Edit user email', $group2->code);
     Permission::create('bindUserToIp', 'Bind user to IP', $group2->code);


		Permission::addChildren('assignRolesToUsers', ['viewUsers', 'viewUserRoles']);
	  Permission::addChildren('changeUserPassword', ['viewUsers']);
		Permission::addChildren('deleteUsers', ['viewUsers']);
		Permission::addChildren('createUsers', ['viewUsers']);
		Permission::addChildren('editUsers', ['viewUsers']);
		Permission::addChildren('editUserEmail', ['viewUserEmail']);


		}

	public function safeDown()
	{

	}
}
