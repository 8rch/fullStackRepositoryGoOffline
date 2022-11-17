<?php

use yii\db\Migration;

/**
 * Class m210328_190941_create_pensum_function
 */
class m210328_190941_create_pensum_function extends Migration
{
    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_pensum;
SQL;
        }
        return $check_function;
    }

    public function checkFunction2()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_last_questionnaire;
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
create or replace function function_get_pensum(user_id_in integer, period_id_in integer, with_ref_date_in boolean, ref_date_in text) returns TABLE (
     pensum_id int,
     career_subject_id integer,
     materia_code varchar,
     anio_escolar varchar,
     module_name varchar,
     modulo_id  int,
     tema_name varchar,
     tema_id int,
     attempt int,
     dead_line timestamp 
   ) as $$
begin
    IF with_ref_date_in IS TRUE THEN
 	return  QUERY	(select 
				  pm.pensum_id as pensum_id,
		          cs.id as career_subject_id,
				                cs.code as materia_code,
				                cs.code as anio_escolar,
				                m."name"  as modulo_name,
				                m.id as modulo_id,
				                t."name" as tema_name,
				                t.id as tema_id,
				                aq.attempt  as attempt,
				                qst.dead_line as dead_line  
				from topic t
				left join questionnaire qst on t.id = qst.topic_id 
				inner join answer_questionnaire aq on qst.id= aq.questionnaire_id 
				left join academic_planning ap on t.id = ap.topic_id 
				left join "module" m on ap.module_id = m.id 
				left join career_subject cs on ap.career_subject_id = cs.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id
				where u.id = user_id_in and up.period_id = period_id_in
				and 
				qst.deleted_at is null and qst.deleted_by = 0
				and aq.deleted_at is null and aq.deleted_by = 0
				and ap.deleted_at is null and ap.deleted_by =0
				and m.deleted_at is null and m.deleted_by =0
				and cs.deleted_at is null and cs.deleted_by =0
				and pm.deleted_at is null and pm.deleted_by =0
				and up.deleted_at is null and up.deleted_by =0
				and p2.deleted_at is null and p2.deleted_by =0
				and aq.created_at = (function_get_last_questionnaire(qst.id, user_id_in))
				and qst.dead_line between (concat(ref_date_in,' ',' 00:00:00'))::timestamp and (concat(ref_date_in, ' ', ' 23:59:59'))::timestamp
				UNION	
			select 
				  pm.pensum_id as pensum_id,
			        cs.id as career_subject_id,
				                cs.code as materia_code,
				                cs.code as anio_escolar,
				                m."name"  as modulo_name,
				                m.id as modulo_id,
				                t."name" as tema_name,
				                t.id as tema_id,
				                0 as attempt,
				                qst.dead_line as dead_line
				from topic t
				left join questionnaire qst on t.id = qst.topic_id 
				inner join academic_planning ap on t.id = ap.topic_id 
				inner join "module" m on ap.module_id = m.id 
				left join career_subject cs on ap.career_subject_id = cs.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id 
				where
				qst.deleted_at is null and qst.deleted_by = 0
				and ap.deleted_at is null and ap.deleted_by =0
				and m.deleted_at is null and m.deleted_by =0
				and cs.deleted_at is null and cs.deleted_by =0
				and pm.deleted_at is null and pm.deleted_by =0
				and up.deleted_at is null and up.deleted_by =0
				and p2.deleted_at is null and p2.deleted_by =0
				and u.id = user_id_in and up.period_id = period_id_in 
				and qst.dead_line between (concat(ref_date_in,' ',' 00:00:00'))::timestamp and (concat(ref_date_in, ' ', ' 23:59:59'))::timestamp);

	ELSE
		return  QUERY	(select 
				  pm.pensum_id as pensum_id,
		          cs.id as career_subject_id,
				                cs.code as materia_code,
				                cs.code as anio_escolar,
				                m."name"  as modulo_name,
				                m.id as modulo_id,
				                t."name" as tema_name,
				                t.id as tema_id,
				                aq.attempt  as attempt,
				                qst.dead_line as dead_line  
				from topic t
				left join questionnaire qst on t.id = qst.topic_id 
				inner join answer_questionnaire aq on qst.id= aq.questionnaire_id 
				left join academic_planning ap on t.id = ap.topic_id 
				left join "module" m on ap.module_id = m.id 
				left join career_subject cs on ap.career_subject_id = cs.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id
				where
				qst.deleted_at is null and qst.deleted_by = 0
				and aq.deleted_at is null and aq.deleted_by = 0
				and ap.deleted_at is null and ap.deleted_by =0
				and m.deleted_at is null and m.deleted_by =0
				and cs.deleted_at is null and cs.deleted_by =0
				and pm.deleted_at is null and pm.deleted_by =0
				and up.deleted_at is null and up.deleted_by =0
				and p2.deleted_at is null and p2.deleted_by =0
				and u.id = user_id_in and up.period_id = period_id_in
				and aq.created_at = (function_get_last_questionnaire(qst.id, user_id_in))
				UNION	
			select 
				  pm.pensum_id as pensum_id,
			        cs.id as career_subject_id,
				                cs.code as materia_code,
				                cs.code as anio_escolar,
				                m."name"  as modulo_name,
				                m.id as modulo_id,
				                t."name" as tema_name,
				                t.id as tema_id,
				                0 as attempt,
				                qst.dead_line as dead_line
				from topic t
				left join questionnaire qst on t.id = qst.topic_id 
				inner join academic_planning ap on t.id = ap.topic_id 
				inner join "module" m on ap.module_id = m.id 
				left join career_subject cs on ap.career_subject_id = cs.id 
				inner join pensum_module pm on m.id = pm.id 
				inner join user_period up on pm.pensum_id = up.pensum_id 
				inner join pensum p2 on pm.pensum_id  = p2.id 
				inner join "user" u on up.user_id = u.id 
				where 
				qst.deleted_at is null and qst.deleted_by = 0
				and ap.deleted_at is null and ap.deleted_by =0
				and m.deleted_at is null and m.deleted_by =0
				and cs.deleted_at is null and cs.deleted_by =0
				and pm.deleted_at is null and pm.deleted_by =0
				and up.deleted_at is null and up.deleted_by =0
				and p2.deleted_at is null and p2.deleted_by =0
				and u.id = user_id_in and up.period_id = period_id_in );
	end if;
end; $$ language plpgsql;
SQL;

$function2 = <<< SQL
CREATE OR REPLACE FUNCTION function_get_last_questionnaire(integer, integer)
 RETURNS timestamp
AS $$
begin
return  (select max(aq2.created_at) from answer_questionnaire aq2
		where aq2.questionnaire_id = $1::integer
		and aq2.user_id = $2::integer);
	end
$$ language plpgsql;
SQL;
            $this->execute($this->checkFunction2());
            $this->execute($this->checkFunction1());
            $this->execute($function2);
            $this->execute($function);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute($this->checkFunction2());
        $this->execute($this->checkFunction1());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210328_190941_create_pensum_function cannot be reverted.\n";

        return false;
    }
    */
}
