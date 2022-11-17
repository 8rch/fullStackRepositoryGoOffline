<?php

use yii\db\Migration;

/**
 * Class m210227_030955_alter_pensum_career_subject_table
 */
class m210227_030955_alter_pensum_career_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('pensum_career_subject');
        $this->createTable('{{%pensum_module}}', [
            'id' => $this->primaryKey(),
            'pensum_id' => $this->integer()->notNull(),
            'module_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `pensum_id`
        $this->createIndex(
            '{{%idx-pensum_module_pensum_id}}',
            '{{%pensum_module}}',
            'pensum_id'
        );

        // add foreign key for table `{{%pensum}}`
        $this->addForeignKey(
            '{{%fk-pensum_module_pensum_id}}',
            '{{%pensum_module}}',
            'pensum_id',
            '{{%pensum}}',
            'id',
            'CASCADE'
        );

        // creates index for column `pensum_id`
        $this->createIndex(
            '{{%idx-pensum_module_module_id}}',
            '{{%pensum_module}}',
            'module_id'
        );

        // add foreign key for table `{{%pensum}}`
        $this->addForeignKey(
            '{{%fk-pensum_module_module_id}}',
            '{{%pensum_module}}',
            'module_id',
            '{{%module}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210227_030955_alter_pensum_career_subject_table cannot be reverted.\n";

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210227_030955_alter_pensum_career_subject_table cannot be reverted.\n";

        return false;
    }
    */
}
