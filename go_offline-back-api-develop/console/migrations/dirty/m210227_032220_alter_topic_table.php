<?php

use yii\db\Migration;

/**
 * Class m210227_032220_alter_topic_table
 */
class m210227_032220_alter_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('topic','module_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210227_032220_alter_topic_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210227_032220_alter_topic_table cannot be reverted.\n";

        return false;
    }
    */
}
