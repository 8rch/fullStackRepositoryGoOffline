<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_period}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210121_021149_create_user_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_period}}', [
            'id' => $this->primaryKey(),
            'first_partial_note' => $this->decimal(5,2)->defaultValue(0),
            'second_partial_note' => $this->decimal(5,2)->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'period_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_period-user_id}}',
            '{{%user_period}}',
            'user_id'
        );

        // creates index for column `period_id`
        $this->createIndex(
            '{{%idx-user_period-period_id}}',
            '{{%user_period}}',
            'period_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_period-user_id}}',
            '{{%user_period}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_period-period_id}}',
            '{{%user_period}}',
            'period_id',
            '{{%period}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_period-user_id}}',
            '{{%user_period}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_period-user_id}}',
            '{{%user_period}}'
        );

        $this->dropTable('{{%user_period}}');
    }
}
