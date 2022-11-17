<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%career_subject}}`.
 */
class m210121_022909_create_career_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%career_subject}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'responsible_name' => $this->string()->notNull(),
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
        $this->dropTable('{{%career_subject}}');
    }
}
