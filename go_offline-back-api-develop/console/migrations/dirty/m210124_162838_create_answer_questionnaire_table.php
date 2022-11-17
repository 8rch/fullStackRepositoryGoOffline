<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer_questionnaire}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%questionnaire}}`
 * - `{{%user}}`
 */
class m210124_162838_create_answer_questionnaire_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer_questionnaire}}', [
            'id' => $this->primaryKey(),
            'questionnaire_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'answers_user' => 'JSONB NOT NULL',
            'answer_correct' => 'JSONB NOT NULL',
            'answer_incorrect' => 'JSONB NOT NULL',
        ]);

        // creates index for column `questionnaire_id`
        $this->createIndex(
            '{{%idx-answer_questionnaire-questionnaire_id}}',
            '{{%answer_questionnaire}}',
            'questionnaire_id'
        );

        // add foreign key for table `{{%questionnaire}}`
        $this->addForeignKey(
            '{{%fk-answer_questionnaire-questionnaire_id}}',
            '{{%answer_questionnaire}}',
            'questionnaire_id',
            '{{%questionnaire}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-answer_questionnaire-user_id}}',
            '{{%answer_questionnaire}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-answer_questionnaire-user_id}}',
            '{{%answer_questionnaire}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%questionnaire}}`
        $this->dropForeignKey(
            '{{%fk-answer_questionnaire-questionnaire_id}}',
            '{{%answer_questionnaire}}'
        );

        // drops index for column `questionnaire_id`
        $this->dropIndex(
            '{{%idx-answer_questionnaire-questionnaire_id}}',
            '{{%answer_questionnaire}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-answer_questionnaire-user_id}}',
            '{{%answer_questionnaire}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-answer_questionnaire-user_id}}',
            '{{%answer_questionnaire}}'
        );

        $this->dropTable('{{%answer_questionnaire}}');
    }
}
