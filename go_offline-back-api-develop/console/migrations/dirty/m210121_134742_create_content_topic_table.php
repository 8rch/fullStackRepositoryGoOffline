<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%content_topic}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%topic}}`
 */
class m210121_134742_create_content_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%content_topic}}', [
            'id' => $this->primaryKey(),
            'topic_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `topic_id`
        $this->createIndex(
            '{{%idx-content_topic-topic_id}}',
            '{{%content_topic}}',
            'topic_id'
        );

        // add foreign key for table `{{%topic}}`
        $this->addForeignKey(
            '{{%fk-content_topic-topic_id}}',
            '{{%content_topic}}',
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
            '{{%fk-content_topic-topic_id}}',
            '{{%content_topic}}'
        );

        // drops index for column `topic_id`
        $this->dropIndex(
            '{{%idx-content_topic-topic_id}}',
            '{{%content_topic}}'
        );

        $this->dropTable('{{%content_topic}}');
    }
}
