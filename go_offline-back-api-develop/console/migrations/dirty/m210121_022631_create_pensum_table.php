<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pensum}}`.
 */
class m210121_022631_create_pensum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pensum}}', [
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
        $this->dropTable('{{%pensum}}');
    }
}
