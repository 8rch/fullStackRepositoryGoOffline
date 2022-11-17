<?php

use yii\db\Migration;

/**
 * Class m210325_131600_insert_params_data
 */
class m210325_131600_insert_params_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->insert('params',['name'=>'max_answer_attempts','value'=>'3', 'created_at'=>'now()','created_by'=>'1']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210325_131600_insert_params_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210325_131600_insert_params_data cannot be reverted.\n";

        return false;
    }
    */
}
