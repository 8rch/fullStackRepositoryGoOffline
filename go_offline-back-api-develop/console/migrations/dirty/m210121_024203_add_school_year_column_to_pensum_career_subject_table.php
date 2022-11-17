<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pensum_career_subject}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%school_year}}`
 */
class m210121_024203_add_school_year_column_to_pensum_career_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pensum_career_subject}}', 'school_year_id', $this->integer()->notNull());

        // creates index for column `school_year_id`
        $this->createIndex(
            '{{%idx-pensum_career_subject-school_year_id}}',
            '{{%pensum_career_subject}}',
            'school_year_id'
        );

        // add foreign key for table `{{%school_year}}`
        $this->addForeignKey(
            '{{%fk-pensum_career_subject-school_year_id}}',
            '{{%pensum_career_subject}}',
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
        // drops foreign key for table `{{%school_year}}`
        $this->dropForeignKey(
            '{{%fk-pensum_career_subject-school_year_id}}',
            '{{%pensum_career_subject}}'
        );

        // drops index for column `school_year_id`
        $this->dropIndex(
            '{{%idx-pensum_career_subject-school_year_id}}',
            '{{%pensum_career_subject}}'
        );

        $this->dropColumn('{{%pensum_career_subject}}', 'school_year_id');
    }
}
