<?php

use yii\db\Migration;

/**
 * Class m210403_002116_create_filtered_questionnaire_function
 */
class m210403_002116_create_filtered_questionnaire_function extends Migration
{
    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_questionnaire_filtered(int4,int4);
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
create or replace function function_get_questionnaire_filtered(topic_id_in integer, user_id_in integer)
   RETURNS TABLE(topic_code character varying, topic_id integer, questionnaire_id integer, type character varying, content text, questions jsonb, answers jsonb, attempt integer)
 as $$
begin
 CREATE TEMP table temporal (
     topic_code varchar,
     topic_id integer,
     questionnaire_id integer,
     "type" character varying,
     "content" text,
     questions jsonb,
     answers  jsonb,
     attempt integer
     )
      ON COMMIT DROP;
	
     insert into  temporal select * from function_getquestionnaire(topic_id_in::int4,user_id_in::int4)  ;

    DELETE FROM
    temporal a
        USING temporal b
	WHERE
	    a.attempt < b.attempt 
	    AND a.topic_id = b.topic_id and a.questionnaire_id = b.questionnaire_id and a."type"= b."type" ;
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
        echo "m210403_002116_create_filtered_questionnaire_function cannot be reverted.\n";

       // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210403_002116_create_filtered_questionnaire_function cannot be reverted.\n";

        return false;
    }
    */
}
