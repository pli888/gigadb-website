<?php

class m200418_114325_subwiz_create_template_attribute_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE template_attribute (
            id serial NOT NULL,
            template_name_id integer,
            attribute_id integer,
            CONSTRAINT template_attribute_pkey PRIMARY KEY (id),
            CONSTRAINT template_attribute_sample_template_id_fkey FOREIGN KEY (template_name_id) REFERENCES template_name(id) ON DELETE CASCADE NOT DEFERRABLE,
            CONSTRAINT template_attribute_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id) ON DELETE CASCADE NOT DEFERRABLE) 
            WITH (oids = false);
        ");
    }

    public function down()
    {
        $this->execute("DROP TABLE template_attribute;");
    }
}
