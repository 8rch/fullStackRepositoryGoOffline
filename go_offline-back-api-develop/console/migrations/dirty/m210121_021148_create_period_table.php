<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%period}}`.
 */
class m210121_021148_create_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%period}}', [
            'id' => $this->primaryKey(),
            'init_date' => $this->timestamp()->notNull(),
            'end_date' => $this->timestamp()->notNull(),
            'end_date_to_deadline' => $this->timestamp()->notNull(),
            'end_date_exam_score_deadline' => $this->timestamp()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%period}}');
    }
}
