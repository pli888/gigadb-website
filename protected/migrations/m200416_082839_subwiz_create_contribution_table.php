<?php

class m200416_082839_subwiz_create_contribution_table extends CDbMigration
{
    public function safeUp()
    {
        // Using plain SQL for schema changes since Yii column
        // types e.g. string will be converted to only varchar(255)
        // and cannot specify smaller varchar sizes
        $sql_createtab = sprintf(
            'CREATE TABLE "contribution" (
                id integer NOT NULL,
                name character varying(255) NOT NULL);'
        );

        $sql_createseq = sprintf(
            'CREATE SEQUENCE contribution_id_seq 
                START WITH 15
                INCREMENT BY 1
                NO MINVALUE 
                NO MAXVALUE 
                CACHE 1 
                OWNED BY contribution.id;'
        );

        $sql_alterseq = sprintf(
            'ALTER SEQUENCE contribution_id_seq 
                OWNED BY contribution.id;'
        );

        $sql_altertab1 = sprintf(
            'ALTER TABLE ONLY contribution
                ALTER COLUMN id SET DEFAULT nextval(\'contribution_id_seq\'::regclass);'
        );

        $sql_altertab2 = sprintf(
            'ALTER TABLE ONLY contribution
                ADD CONSTRAINT contribution_pkey PRIMARY KEY (id);'
        );

        $sql_altertab3 = sprintf(
            'ALTER TABLE ONLY contribution
                ADD CONSTRAINT contribution_unique_name UNIQUE (name);'
        );

        $sql_cmds = array( $sql_createtab, $sql_createseq, $sql_alterseq, $sql_altertab1, $sql_altertab2, $sql_altertab3);
        foreach ($sql_cmds as $sql_cmd)
            Yii::app()->db->createCommand($sql_cmd)->execute();

        // Add data to table. Using insert() method from
        // CDbMigration because the code looks cleaner,
        // logging is provided and will be easier to update
        // if required.
        // Contributor roles from https://casrai.org/credit/
        $this->insert('contribution', array(
            'id' => '1',
            'name' =>'Conceptualization'
        ));
        $this->insert('contribution', array(
            'id' => '2',
            'name' =>'Data curation'
        ));
        $this->insert('contribution', array(
            'id' => '3',
            'name' =>'Formal Analysis'
        ));
        $this->insert('contribution', array(
            'id' => '4',
            'name' =>'Funding acquisition'
        ));
        $this->insert('contribution', array(
            'id' => '5',
            'name' =>'Investigation'
        ));
        $this->insert('contribution', array(
            'id' => '6',
            'name' =>'Methodology'
        ));
        $this->insert('contribution', array(
            'id' => '7',
            'name' =>'Project administration'
        ));
        $this->insert('contribution', array(
            'id' => '8',
            'name' =>'Resources'
        ));
        $this->insert('contribution', array(
            'id' => '9',
            'name' =>'Software'
        ));
        $this->insert('contribution', array(
            'id' => '10',
            'name' =>'Supervision'
        ));
        $this->insert('contribution', array(
            'id' => '11',
            'name' =>'Validation'
        ));
        $this->insert('contribution', array(
            'id' => '12',
            'name' =>'Visualization'
        ));
        $this->insert('contribution', array(
            'id' => '13',
            'name' =>'Writing – original draft'
        ));
        $this->insert('contribution', array(
            'id' => '14',
            'name' =>'Writing – review & editing'
        ));
    }
	public function safeDown()
	{
        // Don't think you can drop SEQUENCE with a
        // function in CDbMigration
        Yii::app()->db->createCommand('DROP SEQUENCE contribution_id_seq CASCADE;')->execute();
        $this->dropTable('contribution');
	}
}
