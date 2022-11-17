<?php

use yii\db\Migration;

/**
 * Class m210227_164252_alter_academic_planning_table
 */
class m210227_164252_alter_academic_planning_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('academic_planning','school_year_id','integer');

        // creates index for column `school_year_id`
        $this->createIndex(
            '{{%idx-academic_planning-school_year_id}}',
            '{{%academic_planning}}',
            'module_id'
        );

        // add foreign key for table `{{%school_year}}`
        $this->addForeignKey(
            '{{%fk-academic_planning-school_year_id}}',
            '{{%academic_planning}}',
            'school_year_id',
            '{{%school_year}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210227_164252_alter_academic_planning_table cannot be reverted.\n";

      //  return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210227_164252_alter_academic_planning_table cannot be reverted.\n";

        return false;
    }
    */
}
