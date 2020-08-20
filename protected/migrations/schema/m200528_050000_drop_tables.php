<?php

class m200528_050000_drop_tables extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("DROP VIEW IF EXISTS show_accession;");
        $this->execute("DROP VIEW IF EXISTS show_manuscript;");
        $this->execute("DROP VIEW IF EXISTS show_project;");
        $this->execute("DROP VIEW IF EXISTS show_externallink;");
        $this->execute("DROP VIEW IF EXISTS show_file;");
        $this->execute("DROP VIEW IF EXISTS homepage_dataset_type;");
        $this->execute("DROP VIEW IF EXISTS file_number;");
        $this->execute("DROP VIEW IF EXISTS sample_number;");

        $this->execute("DROP TABLE IF EXISTS user_command CASCADE;");
        $this->execute("DROP TABLE IF EXISTS search CASCADE;");
        $this->execute("DROP TABLE IF EXISTS sample_rel CASCADE;");
        $this->execute("DROP TABLE IF EXISTS sample_experiment CASCADE;");
        $this->execute("DROP TABLE IF EXISTS sample_attribute CASCADE;");
        $this->execute("DROP TABLE IF EXISTS rss_message CASCADE;");
        $this->execute("DROP TABLE IF EXISTS relation CASCADE;");
        $this->execute("DROP TABLE IF EXISTS prefix CASCADE;");
        $this->execute("DROP TABLE IF EXISTS news CASCADE;");
        $this->execute("DROP TABLE IF EXISTS manuscript CASCADE;");
        $this->execute("DROP TABLE IF EXISTS link CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_sample CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_relationship CASCADE;");
        $this->execute("DROP TABLE IF EXISTS relationship CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_experiment CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_attributes CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_type CASCADE;");
        $this->execute("DROP TABLE IF EXISTS file_format CASCADE;");
        $this->execute("DROP TABLE IF EXISTS external_link CASCADE;");
        $this->execute("DROP TABLE IF EXISTS external_link_type CASCADE;");
        $this->execute("DROP TABLE IF EXISTS exp_attributes CASCADE;");
        $this->execute("DROP TABLE IF EXISTS experiment CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_type CASCADE;");
        $this->execute("DROP TABLE IF EXISTS type CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_session CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_sample CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_project CASCADE;");
        $this->execute("DROP TABLE IF EXISTS project CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_log CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_funder CASCADE;");
        $this->execute("DROP TABLE IF EXISTS funder_name CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_author CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset_attributes CASCADE;");
        $this->execute("DROP TABLE IF EXISTS unit CASCADE;");
        $this->execute("DROP TABLE IF EXISTS curation_log CASCADE;");
        $this->execute("DROP TABLE IF EXISTS dataset CASCADE;");
        $this->execute("DROP TABLE IF EXISTS publisher CASCADE;");
        $this->execute("DROP TABLE IF EXISTS image CASCADE;");
        $this->execute("DROP TABLE IF EXISTS author_rel CASCADE;");
        $this->execute("DROP TABLE IF EXISTS author CASCADE;");
        $this->execute("DROP TABLE IF EXISTS attribute CASCADE;");
        $this->execute("DROP TABLE IF EXISTS alternative_identifiers CASCADE;");
        $this->execute("DROP TABLE IF EXISTS sample CASCADE;");
        $this->execute("DROP TABLE IF EXISTS gigadb_user CASCADE;");
        $this->execute("DROP TABLE IF EXISTS species CASCADE;");
        $this->execute("DROP TABLE IF EXISTS extdb CASCADE;");
        $this->execute("DROP TABLE IF EXISTS YiiSession CASCADE;");
        $this->execute("DROP TABLE IF EXISTS AuthAssignment CASCADE;");
        $this->execute("DROP TABLE IF EXISTS AuthItem CASCADE;");
    }
}
