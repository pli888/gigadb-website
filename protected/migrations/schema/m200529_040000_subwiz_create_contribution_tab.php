<?php

class m200529__40000_subwiz_create_contribution_tab extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE contribution (
            id integer NOT NULL,
            name character varying(255) NOT NULL,
            source character varying(255) NOT NULL,
            description character varying(255) NOT NULL);");

        $this->execute("CREATE SEQUENCE contribution_id_seq 
            START WITH 15
            INCREMENT BY 1
            NO MINVALUE 
            NO MAXVALUE 
            CACHE 1 
            OWNED BY contribution.id;");

        $this->execute("ALTER SEQUENCE contribution_id_seq 
                OWNED BY contribution.id;");

        $this->execute("ALTER TABLE ONLY contribution
            ALTER COLUMN id SET DEFAULT nextval('contribution_id_seq'::regclass);");

        $this->execute("ALTER TABLE ONLY contribution
                ADD CONSTRAINT contribution_pkey PRIMARY KEY (id);");

        $this->execute("ALTER TABLE ONLY contribution
                ADD CONSTRAINT contribution_unique_name UNIQUE (name);");
    }

    public function safeDown()
    {
        $this->execute("DROP SEQUENCE contribution_id_seq CASCADE;");
        $this->dropTable('contribution');
    }
}
