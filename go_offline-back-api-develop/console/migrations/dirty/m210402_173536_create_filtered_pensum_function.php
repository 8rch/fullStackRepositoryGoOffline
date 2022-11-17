<?php

use yii\db\Migration;

/**
 * Class m210402_173536_create_filtered_pensum_function
 */
class m210402_173536_create_filtered_pensum_function extends Migration
{
    public function checkFunction1()
    {
        $check_function = "";
        if ($this->db->driverName === 'pgsql') {
            $check_function = <<< SQL
DROP FUNCTION IF EXISTS function_get_pensum_filtered(int4,int4,boolean,text);
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
create or replace function function_get_pensum_filtered(user_id_in integer, period_id_in integer, with_ref_date_in boolean, ref_date_in text) returns TABLE (
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
	 CREATE TEMP table temporal (
     pensum_id integer,
     career_subject_id integer,
     materia_code varchar(255),
     anio_escolar varchar(255),
     modulo_name varchar(255),
     modulo_id  integer,
     tema_name varchar(255),
     tema_id integer,
     attempt integer,
     dead_line timestamp)
      ON COMMIT DROP;
	
     insert into  temporal select * from function_get_pensum(user_id_in::int4,period_id_in::int4, with_ref_date_in::boolean, ref_date_in::text)  ;

    DELETE FROM
    temporal a
        USING temporal b
	WHERE
	    a.attempt < b.attempt 
	    AND a.tema_id = b.tema_id and a.pensum_id = b.pensum_id and a.career_subject_id= b.career_subject_id and a.modulo_id= b.modulo_id  ;
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
        echo "m210402_173536_create_filtered_pensum_function cannot be reverted.\n";

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210402_173536_create_filtered_pensum_function cannot be reverted.\n";

        return false;
    }
    */
}
