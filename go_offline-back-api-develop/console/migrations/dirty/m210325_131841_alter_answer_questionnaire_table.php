<?php

use yii\db\Migration;

/**
 * Class m210325_131841_alter_answer_questionnaire_table
 */
class m210325_131841_alter_answer_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('answer_questionnaire','attempt','int not null default 1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210325_131841_alter_answer_questionnaire_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210325_131841_alter_answer_questionnaire_table cannot be reverted.\n";

        return false;
    }
    */
}
