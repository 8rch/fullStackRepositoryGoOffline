<?php

use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use yii\db\Migration;

class m141207_001651_create_basic_user_permissions_3 extends Migration
{
	public function safeUp()
	{

		// ================= User common permissions =================
		$group = new AuthItemGroup();
		$group->name = 'User common permission';
		$group->code = 'userCommonPermissions';
		$group->save(false);

		Role::assignRoutesViaPermission('Admin','changeOwnPassword', ['/user-management/auth/change-own-password'], 'Change own password', $group->code);
	}

	public function safeDown()
	{
	}
}
