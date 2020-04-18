<?php

class m200418_114320_subwiz_create_sample_template_table extends CDbMigration
{
    public function up()
    {
        $this->execute("CREATE TABLE sample_template (
            id serial NOT NULL,
            name character varying(255) NOT NULL);
        ");

        $this->execute("ALTER TABLE ONLY sample_template
                ADD CONSTRAINT sample_template_pkey PRIMARY KEY (id);
        ");
    }

    public function down()
    {
        $this->execute("DROP TABLE sample_template;");
    }
}
