<?php

use yii\db\Migration;

/**
 * Class m210402_142953_create_get_questionnaire_function
 */
class m210402_142953_create_get_questionnaire_function extends Migration
{

    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_getQuestionnaire(int4,int4);
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
create or replace function function_getQuestionnaire(topic_id_in integer, user_id_in integer)
  returns TABLE (
     topic_code varchar,
     topic_id integer,
     questionnaire_id integer,
     "type" varchar(255),
     "content" text,
     questions  jsonb,
     answers jsonb,
     attempt int
     ) as $$
begin
	 	return  QUERY (
	 		select 
	                t2.code as topic_code, 
	                t2.id as topic_id,
	                q2.id as questionnaire_id,
	                q2."type" as "type",
	                q2."content" as "content",
	                q2.questions as questions,
	                q2.answers as answers,
	                aq.attempt as attempt
	                from topic t2 
	                left join questionnaire q2 on q2.topic_id = t2.id
	                left join answer_questionnaire aq on q2.id=aq.questionnaire_id 
	                where t2.id = topic_id_in  and q2.topic_id = topic_id_in
	               and aq.user_id = user_id_in
	               union 
				select 
				  t.code as topic_code, 
	                t.id as topic_id,
	                q2.id as questionnaire_id,
	                q2."type" as "type",
	                q2."content" as "content",
	                q2.questions as questions,
	                q2.answers as answers,
	                0 as attempt
				from topic t
				left join questionnaire q2 on t.id = q2.topic_id 
				inner join academic_planning ap on t.id = ap.topic_id 
				inner join "module" m on ap.module_id = m.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id 
				where u.id = user_id_in and t.id = topic_id_in
				);
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
        echo "m210402_142953_create_get__questionnaire_function cannot be reverted.\n";

      //  return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210402_142953_create_get__questionnaire_function cannot be reverted.\n";

        return false;
    }
    */
}
