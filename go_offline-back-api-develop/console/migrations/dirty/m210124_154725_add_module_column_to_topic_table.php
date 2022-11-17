<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%topic}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%module}}`
 */
class m210124_154725_add_module_column_to_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%topic}}', 'module_id', $this->integer()->notNull());

        // creates index for column `module_id`
        $this->createIndex(
            '{{%idx-topic-module_id}}',
            '{{%topic}}',
            'module_id'
        );

        // add foreign key for table `{{%module}}`
        $this->addForeignKey(
            '{{%fk-topic-module_id}}',
            '{{%topic}}',
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
            '{{%fk-topic-module_id}}',
            '{{%topic}}'
        );

        // drops index for column `module_id`
        $this->dropIndex(
            '{{%idx-topic-module_id}}',
            '{{%topic}}'
        );

        $this->dropColumn('{{%topic}}', 'module_id');
    }
}
