<?php

class m200418_114320_subwiz_create_template_name_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE template_name (
            id integer NOT NULL,
            template_name character varying(50) NOT NULL,
            template_description character varying(255),
            notes character varying(255));"
        );

        $this->execute("CREATE SEQUENCE template_name_id_seq
                START WITH 1
                INCREMENT BY 1
                NO MINVALUE
                NO MAXVALUE
                CACHE 1
                OWNED BY template_name.id;"
        );

        $this->execute("ALTER TABLE ONLY template_name
                ADD CONSTRAINT template_name_pkey PRIMARY KEY (id);"
        );
    }

    public function down()
    {
        $this->execute("DROP SEQUENCE template_name_id_seq CASCADE;");
        $this->execute("DROP TABLE template_name;");
    }
}
