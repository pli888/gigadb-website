<?php

class m200305_191941_create_rss_message_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        // Using plain SQL for schema changes since Yii column
        // types e.g. string will be converted to only varchar(255)
        // and cannot specify smaller varchar sizes
        $sql_createtab = sprintf(
            'CREATE TABLE rss_message (
                id integer NOT NULL,
                message character varying(128) NOT NULL,
                publication_date date DEFAULT (\'now\'::text)::date NOT NULL);'
        );

        $sql_createseq = sprintf(
            'CREATE SEQUENCE rss_message_id_seq
                START WITH 1
                INCREMENT BY 1
                NO MINVALUE
                NO MAXVALUE
                CACHE 1;'
        );

        $sql_alterseq = sprintf(
            'ALTER SEQUENCE rss_message_id_seq 
                OWNED BY rss_message.id;'
        );

        $sql_altertab1 = sprintf(
            'ALTER TABLE ONLY rss_message 
                ALTER COLUMN id SET DEFAULT nextval(\'rss_message_id_seq\'::regclass);'
        );

        $sql_altertab2 = sprintf(
            'ALTER TABLE ONLY rss_message
                ADD CONSTRAINT rss_message_pkey PRIMARY KEY (id);'
        );

        $sql_cmds = array($sql_createtab, $sql_createseq, $sql_alterseq, $sql_altertab1, $sql_altertab2);
        foreach ($sql_cmds as $sql_cmd)
            Yii::app()->db->createCommand($sql_cmd)->execute();
    }

    public function safeDown()
    {
        // Don't think you can drop SEQUENCE with a
        // function in CDbMigration
        Yii::app()->db->createCommand('DROP SEQUENCE rss_message_id_seq CASCADE;')->execute();
        $this->dropTable('rss_message');
    }
}