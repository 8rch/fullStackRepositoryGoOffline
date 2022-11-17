<?php

use yii\db\Migration;

/**
 * Class m210321_143656_alter_answer_questionnaire_table
 */
class m210321_143656_alter_answer_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('answer_questionnaire','created_at','timestamp not null');
        $this->addColumn('answer_questionnaire','updated_at','timestamp');
        $this->addColumn('answer_questionnaire','deleted_at','timestamp');
        $this->addColumn('answer_questionnaire','created_by','integer not null');
        $this->addColumn('answer_questionnaire','updated_by','integer');
        $this->addColumn('answer_questionnaire','deleted_by','integer default 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210321_143656_alter_answer_questionnaire_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210321_143656_alter_answer_questionnaire_table cannot be reverted.\n";

        return false;
    }
    */
}
