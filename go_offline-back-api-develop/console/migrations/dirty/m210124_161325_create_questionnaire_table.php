<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questionnaire}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%topic}}`
 */
class m210124_161325_create_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%questionnaire}}', [
            'id' => $this->primaryKey(),
            'topic_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'questions' => 'JSONB NOT NULL',
            'answers' => 'JSONB NOT NULL',
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `topic_id`
        $this->createIndex(
            '{{%idx-questionnaire-topic_id}}',
            '{{%questionnaire}}',
            'topic_id'
        );

        // add foreign key for table `{{%topic}}`
        $this->addForeignKey(
            '{{%fk-questionnaire-topic_id}}',
            '{{%questionnaire}}',
            'topic_id',
            '{{%topic}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%topic}}`
        $this->dropForeignKey(
            '{{%fk-questionnaire-topic_id}}',
            '{{%questionnaire}}'
        );

        // drops index for column `topic_id`
        $this->dropIndex(
            '{{%idx-questionnaire-topic_id}}',
            '{{%questionnaire}}'
        );

        $this->dropTable('{{%questionnaire}}');
    }
}
