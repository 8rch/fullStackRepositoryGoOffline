<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%academic_planning}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%module}}`
 * - `{{%topic}}`
 */
class m210227_033334_create_academic_planning_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%academic_planning}}', [
            'id' => $this->primaryKey(),
            'module_id' => $this->integer()->notNull(),
            'career_subject_id' => $this->integer()->notNull(),
            'topic_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `module_id`
        $this->createIndex(
            '{{%idx-academic_planning-module_id}}',
            '{{%academic_planning}}',
            'module_id'
        );

        // add foreign key for table `{{%module}}`
        $this->addForeignKey(
            '{{%fk-academic_planning-module_id}}',
            '{{%academic_planning}}',
            'module_id',
            '{{%module}}',
            'id',
            'CASCADE'
        );

        // creates index for column `career_subject`
        $this->createIndex(
            '{{%idx-academic_planning-career_subject_id}}',
            '{{%academic_planning}}',
            'career_subject_id'
        );

        // add foreign key for table `{{%module}}`
        $this->addForeignKey(
            '{{%fk-academic_planning-career_subject_id}}',
            '{{%academic_planning}}',
            'career_subject_id',
            '{{%career_subject}}',
            'id',
            'CASCADE'
        );

        // creates index for column `topic_id`
        $this->createIndex(
            '{{%idx-academic_planning-topic_id}}',
            '{{%academic_planning}}',
            'topic_id'
        );

        // add foreign key for table `{{%topic}}`
        $this->addForeignKey(
            '{{%fk-academic_planning-topic_id}}',
            '{{%academic_planning}}',
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
        // drops foreign key for table `{{%module}}`
        $this->dropForeignKey(
            '{{%fk-academic_planning-module_id}}',
            '{{%academic_planning}}'
        );

        // drops index for column `module_id`
        $this->dropIndex(
            '{{%idx-academic_planning-module_id}}',
            '{{%academic_planning}}'
        );

        // drops foreign key for table `{{%topic}}`
        $this->dropForeignKey(
            '{{%fk-academic_planning-topic_id}}',
            '{{%academic_planning}}'
        );

        // drops index for column `topic_id`
        $this->dropIndex(
            '{{%idx-academic_planning-topic_id}}',
            '{{%academic_planning}}'
        );

        $this->dropTable('{{%academic_planning}}');
    }
}
