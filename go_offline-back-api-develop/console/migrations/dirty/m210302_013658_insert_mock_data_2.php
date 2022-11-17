<?php

use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use yii\db\Migration;

/**
 * Class m210302_013658_insert_mock_data_2
 */
class m210302_013658_insert_mock_data_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //create rol student
        $this->insert('user', ['username' => 'user2',
            'auth_key' => 'E8TCCOZNGGmu9fGe6wqptbYFhArBQKM2',
            'password_hash' => '$2y$13$XMnFGZRmSz.XhtHUTUJVOOpbcyzeS5j5MKVDfEETXfZPv45kvS6S.',
            'status' => 1,
            'superadmin' => 0,
            'created_at' => 1614649377,
            'updated_at' => 1614649377,
            'email' => 'user2@hotmail.com']);
        $user_id = Yii::$app->db->getLastInsertID();

        //create rol user2
        Role::create('student', $description = null, $groupCode = null, $ruleName = null, $data = null);
        User::assignRole($user_id, 'student');

        //asignar student al user2

        //agregar academic planing
        $this->insert('academic_planning',
            ['module_id' => 1, 'career_subject_id' => 1, 'topic_id' => 1,
                'created_at' => '2020-03-01 00:00:00',
                'created_by' => 1,
                'school_year_id' => 1,
                'deleted_by' => 0
            ]);

        $this->insert('user_period',[
            'user_id'=>$user_id,
            'period_id'=>1,
            'created_at' => '2020-03-01 00:00:00',
            'created_by' => 1,
            'deleted_by' => 0,
            'pensum_id'=>1,
        ]);

        $this->insert('pensum_module',[
            'pensum_id'=>1,
            'module_id'=>1,
            'created_at' => '2020-03-01 00:00:00',
            'created_by' => 1,
            'deleted_by' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210302_013658_insert_mock_data_2 cannot be reverted.\n";

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210302_013658_insert_mock_data_2 cannot be reverted.\n";

        return false;
    }
    */
}
