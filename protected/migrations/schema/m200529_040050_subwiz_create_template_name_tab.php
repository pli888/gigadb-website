<?php

class m200529_040050_subwiz_create_template_name_tab extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE template_name (
            id integer NOT NULL,
            template_name character varying(50) NOT NULL,
            template_description character varying(500),
            notes character varying(255));");

        $this->execute("CREATE SEQUENCE template_name_id_seq
            START WITH 1
            INCREMENT BY 1
            NO MINVALUE
            NO MAXVALUE
            CACHE 1
            OWNED BY template_name.id;");

        $this->execute("ALTER TABLE ONLY template_name
            ADD CONSTRAINT template_name_pkey PRIMARY KEY (id);");
    }

    public function safeDown()
    {
        $this->execute("DROP SEQUENCE template_name_id_seq CASCADE;");
        $this->dropTable('template_name');
    }
}

