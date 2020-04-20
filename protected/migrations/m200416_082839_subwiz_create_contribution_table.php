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
                name character varying(255) NOT NULL,
                source character varying(255) NOT NULL,
                description character varying(255) NOT NULL);'
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
            'name' =>'Conceptualization',
            'source' => 'https://casrai.org/credit',
            'description' => 'Ideas; formulation or evolution of overarching research goals and aims.'
        ));
        $this->insert('contribution', array(
            'id' => '2',
            'name' =>'Data curation',
            'source' => 'https://casrai.org/credit',
            'description' => 'Management activities to annotate (produce metadata), scrub data and maintain research data (including software code, where it is necessary for interpreting the data itself) for initial use and later re-use.'
        ));
        $this->insert('contribution', array(
            'id' => '3',
            'name' =>'Formal Analysis',
            'source' => 'https://casrai.org/credit',
            'description' => 'Application of statistical, mathematical, computational, or other formal techniques to analyze or synthesize study data.'

        ));
        $this->insert('contribution', array(
            'id' => '4',
            'name' =>'Funding acquisition',
            'source' => 'https://casrai.org/credit',
            'description' => 'Acquisition of the financial support for the project leading to this publication.'
        ));
        $this->insert('contribution', array(
            'id' => '5',
            'name' =>'Investigation',
            'source' => 'https://casrai.org/credit',
            'description' => 'Conducting a research and investigation process, specifically performing the experiments, or data/evidence collection.'
        ));
        $this->insert('contribution', array(
            'id' => '6',
            'name' =>'Methodology',
            'source' => 'https://casrai.org/credit',
            'description' => 'Development or design of methodology; creation of models.'
        ));
        $this->insert('contribution', array(
            'id' => '7',
            'name' =>'Project administration',
            'source' => 'https://casrai.org/credit',
            'description' => 'Management and coordination responsibility for the research activity planning and execution.'
        ));
        $this->insert('contribution', array(
            'id' => '8',
            'name' =>'Resources',
            'source' => 'https://casrai.org/credit',
            'description' => 'Provision of study materials, reagents, materials, patients, laboratory samples, animals, instrumentation, computing resources, or other analysis tools.'
        ));
        $this->insert('contribution', array(
            'id' => '9',
            'name' =>'Software',
            'source' => 'https://casrai.org/credit',
            'description' => 'Programming, software development; designing computer programs; implementation of the computer code and supporting algorithms; testing of existing code components.'
        ));
        $this->insert('contribution', array(
            'id' => '10',
            'name' =>'Supervision',
            'source' => 'https://casrai.org/credit',
            'description' => 'Oversight and leadership responsibility for the research activity planning and execution, including mentorship external to the core team.'
        ));
        $this->insert('contribution', array(
            'id' => '11',
            'name' =>'Validation',
            'source' => 'https://casrai.org/credit',
            'description' => 'Verification, whether as a part of the activity or separate, of the overall replication/reproducibility of results/experiments and other research outputs.'
        ));
        $this->insert('contribution', array(
            'id' => '12',
            'name' =>'Visualization',
            'source' => 'https://casrai.org/credit',
            'description' => 'Preparation, creation and/or presentation of the published work, specifically visualization/data presentation.'
        ));
        $this->insert('contribution', array(
            'id' => '13',
            'name' =>'Writing – original draft',
            'source' => 'https://casrai.org/credit',
            'description' => 'Preparation, creation and/or presentation of the published work, specifically writing the initial draft (including substantive translation).'
        ));
        $this->insert('contribution', array(
            'id' => '14',
            'name' =>'Writing – review & editing',
            'source' => 'https://casrai.org/credit',
            'description' => 'Preparation, creation and/or presentation of the published work by those from the original research group, specifically critical review, commentary or revision – including pre- or post-publication stages.'
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
