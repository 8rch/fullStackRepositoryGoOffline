<?php

use yii\db\Migration;

/**
 * Class m210121135946_add_module_column_to_pensum_career_subject
 */
class m210121_135946_add_module_column_to_pensum_career_subject extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pensum_career_subject}}', 'module_id', $this->integer()->notNull());

        // creates index for column `module_id`
        $this->createIndex(
            '{{%idx-pensum_career_subject-module_id}}',
            '{{%pensum_career_subject}}',
            'module_id'
        );

        // add foreign key for table `{{%module}}`
        $this->addForeignKey(
            '{{%fk-pensum_career_subject-module_id}}',
            '{{%pensum_career_subject}}',
            'module_id',
            '{{%module}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%module}}`
        $this->dropForeignKey(
            '{{%fk-pensum_career_subject-module_id}}',
            '{{%pensum_career_subject}}'
        );

        // drops index for column `module_id`
        $this->dropIndex(
            '{{%idx-pensum_career_subject-module_id}}',
            '{{%pensum_career_subject}}'
        );

        $this->dropColumn('{{%pensum_career_subject}}', 'module_id');
    }
}
