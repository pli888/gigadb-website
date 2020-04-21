<?php

class m200418_114320_subwiz_create_template_name_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE template_name (
            id serial NOT NULL,
            template_name character varying(50) NOT NULL,
            template_description character varying(255),
            notes character varying(255));
        ");

        $this->execute("ALTER TABLE ONLY template_name
                ADD CONSTRAINT template_name_pkey PRIMARY KEY (id);
        ");
    }

    public function down()
    {
        $this->execute("DROP TABLE template_name;");
    }
}
