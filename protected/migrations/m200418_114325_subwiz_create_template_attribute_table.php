<?php

class m200418_114325_subwiz_create_template_attribute_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE template_attribute (
            id integer NOT NULL,
            template_name_id integer,
            attribute_id integer);
        ");

        $this->execute("CREATE SEQUENCE template_attribute_id_seq
                START WITH 1
                INCREMENT BY 1
                NO MINVALUE
                NO MAXVALUE
                CACHE 1
                OWNED BY template_attribute.id;
        ");

        $this->execute("ALTER TABLE ONLY template_attribute
                ADD CONSTRAINT template_attribute_pkey PRIMARY KEY (id);
        ");

        $this->execute("ALTER TABLE ONLY template_attribute
                ADD CONSTRAINT template_attribute_sample_template_id_fkey FOREIGN KEY (template_name_id) 
                REFERENCES template_name(id) ON DELETE CASCADE NOT DEFERRABLE;
        ");

        $this->execute("ALTER TABLE ONLY template_attribute
                ADD CONSTRAINT template_attribute_attribute_id_fkey FOREIGN KEY (attribute_id) 
                REFERENCES attribute(id) ON DELETE CASCADE NOT DEFERRABLE;
        ");
    }

    public function down()
    {
        $this->execute("DROP SEQUENCE template_attribute_id_seq CASCADE;");
        $this->execute("DROP TABLE template_attribute;");
    }
}
