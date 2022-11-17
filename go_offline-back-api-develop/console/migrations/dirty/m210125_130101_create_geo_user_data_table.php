<?php

use yii\db\Schema;

class m210125_130101_create_geo_user_data_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_user_data}}', [
            'id' => $this->primaryKey(),
            'long' => $this->string(255)->notNull(),
            'lat' => $this->string(255)->notNull(),
            'extra' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'deleted_at' => $this->timestamp(),
            'deleted_by' => $this->integer()->notNull()->defaultValue('0'),
            'created_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
            'updated_by' => $this->integer(),
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%geo_user_data}}');
    }
}
