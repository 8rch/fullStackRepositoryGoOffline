<?php

use yii\db\Migration;

/**
 * Class m210403_004316_create_get_topic_filtered_function
 */
class m210403_004316_create_get_topic_filtered_function extends Migration
{
    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_topic_filtered(int4,int4);
SQL;
        }
        return $check_function;
    }


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'pgsql') {
            $function = <<< SQL
create or replace function function_get_topic_filtered(topic_id_in integer, user_id_in integer)
RETURNS  TABLE(topic_code varchar, topic_id integer, content_topic_id integer, content_topic_content text, attempt integer, dead_line timestamp)
 as $$
begin
	CREATE TEMP table temporal (
     topic_code varchar,
     topic_id integer,
     content_topic_id integer,
     content_topic_content text,
     attempt integer,
     dead_line timestamp)
      ON COMMIT DROP;
	
     insert into  temporal select * from function_get_topic(topic_id_in::int4, user_id_in::int4)  ;

    DELETE FROM
    temporal a
        USING temporal b
	WHERE
	    a.attempt < b.attempt 
	    AND a.topic_id = b.topic_id and a.content_topic_id = b.content_topic_id;
   return  QUERY	(select * from temporal);
    
end; $$ language plpgsql;
SQL;
            $this->execute($this->checkFunction1());
            $this->execute($function);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210403_004316_create_get_topic_filtered_function cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210403_004316_create_get_topic_filtered_function cannot be reverted.\n";

        return false;
    }
    */
}
