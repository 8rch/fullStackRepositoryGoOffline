<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pensum_career_subject}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%pensum}}`
 * - `{{%career_subject}}`
 */
class m210121_023108_create_pensum_career_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pensum_career_subject}}', [
            'id' => $this->primaryKey(),
            'pensum_id' => $this->integer()->notNull(),
            'career_subject_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `pensum_id`
        $this->createIndex(
            '{{%idx-pensum_career_subject-pensum_id}}',
            '{{%pensum_career_subject}}',
            'pensum_id'
        );

        // add foreign key for table `{{%pensum}}`
        $this->addForeignKey(
            '{{%fk-pensum_career_subject-pensum_id}}',
            '{{%pensum_career_subject}}',
            'pensum_id',
            '{{%pensum}}',
            'id',
            'CASCADE'
        );

        // creates index for column `career_subject_id`
        $this->createIndex(
            '{{%idx-pensum_career_subject-career_subject_id}}',
            '{{%pensum_career_subject}}',
            'career_subject_id'
        );

        // add foreign key for table `{{%career_subject}}`
        $this->addForeignKey(
            '{{%fk-pensum_career_subject-career_subject_id}}',
            '{{%pensum_career_subject}}',
            'career_subject_id',
            '{{%career_subject}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%pensum}}`
        $this->dropForeignKey(
            '{{%fk-pensum_career_subject-pensum_id}}',
            '{{%pensum_career_subject}}'
        );

        // drops index for column `pensum_id`
        $this->dropIndex(
            '{{%idx-pensum_career_subject-pensum_id}}',
            '{{%pensum_career_subject}}'
        );

        // drops foreign key for table `{{%career_subject}}`
        $this->dropForeignKey(
            '{{%fk-pensum_career_subject-career_subject_id}}',
            '{{%pensum_career_subject}}'
        );

        // drops index for column `career_subject_id`
        $this->dropIndex(
            '{{%idx-pensum_career_subject-career_subject_id}}',
            '{{%pensum_career_subject}}'
        );

        $this->dropTable('{{%pensum_career_subject}}');
    }
}
