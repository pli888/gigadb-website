<?php

class m200418_072727_subwiz_create_funding_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE funding (
            id serial NOT NULL,
            dataset_id integer NOT NULL,
            funder_id integer NOT NULL,
            program_name character varying(100) NOT NULL,
            \"grant\" character varying(100) NOT NULL,
            pi_name character varying(100) NOT NULL);
        ");

        $this->execute("ALTER TABLE funding
            ADD CONSTRAINT funding_id PRIMARY KEY (id);
        ");
    }

    public function down()
    {
        $this->execute("DROP TABLE funding;");
    }
}
