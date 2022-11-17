<?php

use yii\db\Migration;

/**
 * Class m210403_004021_create_get_topic_function
 */
class m210403_004021_create_get_topic_function extends Migration
{
    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_topic(int4,int4);
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
create or replace function function_get_topic(topic_id_in integer, user_id_in integer)
 RETURNS  TABLE(topic_code varchar, topic_id integer, content_topic_id integer, content_topic_content text, attempt integer, dead_line timestamp)
 as $$
begin
return  QUERY (
	 		select
                t2.code as topic_code, 
                t2.id as topic_id,  
                ct.id as content_topic_id,
                ct."content" as content_topic_content,
                aq.attempt as attempt,
                q2.dead_line as dead_line
                from topic t2 
                left join content_topic ct on t2.id = ct.topic_id 
                left join questionnaire q2 on ct.topic_id = q2.topic_id 
                left join answer_questionnaire aq on q2.id = aq.questionnaire_id 
                where t2.deleted_at is null and t2.deleted_by =0 
                and ct.deleted_at  is null and ct.deleted_by =0
                and q2.deleted_at is null and q2.deleted_by =0
                and q2.topic_id =topic_id_in and aq.user_id  = user_id_in
union                
               select  distinct
				   t2.code as topic_code, 
                t2.id as topic_id,  
                ct.id as content_topic_id,
                ct."content" as content_topic_content,
                0 as attempt,
                q2.dead_line as dead_line
                from topic t2 
                left join content_topic ct on t2.id = ct.topic_id 
                left join questionnaire q2 on ct.id = q2.topic_id 
				inner join academic_planning ap on t2.id = ap.topic_id 
				inner join "module" m on ap.module_id = m.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id 
				where t2.deleted_at is null and t2.deleted_by =0 
                and ct.deleted_at  is null and ct.deleted_by =0
                and q2.deleted_at is null and q2.deleted_by =0
				and t2.id = topic_id_in and u.id = user_id_in 
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
        echo "m210403_004021_create_get_topic_function cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210403_004021_create_get_topic_function cannot be reverted.\n";

        return false;
    }
    */
}
