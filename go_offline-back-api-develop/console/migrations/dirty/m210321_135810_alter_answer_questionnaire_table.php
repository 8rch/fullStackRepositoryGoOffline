<?php

use yii\db\Migration;

/**
 * Class m210321_135810_alter_answer_questionnaire_table
 */
class m210321_135810_alter_answer_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('answer_questionnaire','evaluation_is_correct','boolean not null default false');
        $this->dropColumn('answer_questionnaire','answer_incorrect');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
     //   echo "m210321_135810_alter_answer_questionnaire_table cannot be reverted.\n";

      //  return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210321_135810_alter_answer_questionnaire_table cannot be reverted.\n";

        return false;
    }
    */
}
