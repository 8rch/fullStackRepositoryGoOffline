<?php

use yii\db\Migration;

/**
 * Class m210331_014956_alter_questionnaire_table
 */
class m210331_014956_alter_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('questionnaire','dead_line','timestamp not null default now()');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210331_014956_alter_questionnaire_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210331_014956_alter_questionnaire_table cannot be reverted.\n";

        return false;
    }
    */
}
