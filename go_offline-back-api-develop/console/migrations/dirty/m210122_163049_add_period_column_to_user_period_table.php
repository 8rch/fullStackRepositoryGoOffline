<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_period}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%pensum}}`
 */
class m210122_163049_add_period_column_to_user_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_period}}', 'pensum_id', $this->integer()->notNull());

        // creates index for column `pensum_id`
        $this->createIndex(
            '{{%idx-user_period-pensum_id}}',
            '{{%user_period}}',
            'pensum_id'
        );

        // add foreign key for table `{{%pensum}}`
        $this->addForeignKey(
            '{{%fk-user_period-pensum_id}}',
            '{{%user_period}}',
            'pensum_id',
            '{{%pensum}}',
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
            '{{%fk-user_period-pensum_id}}',
            '{{%user_period}}'
        );

        // drops index for column `pensum_id`
        $this->dropIndex(
            '{{%idx-user_period-pensum_id}}',
            '{{%user_period}}'
        );

        $this->dropColumn('{{%user_period}}', 'pensum_id');
    }
}
