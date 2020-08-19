<?php

class m200528_050000_drop_tables extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("DROP VIEW IF EXISTS show_accession;");
        $this->execute("DROP VIEW IF EXISTS show_manuscript;");
        $this->execute("DROP VIEW IF EXISTS show_project;");
        $this->execute("DROP VIEW IF EXISTS homepage_dataset_type;");
        $this->execute("DROP VIEW IF EXISTS file_number;");
        
        $this->dropTable('user_command');
        $this->dropTable('search');
        $this->dropTable('sample_rel');
        $this->dropTable('sample_experiment');
        $this->dropTable('sample_attribute');
        $this->dropTable('rss_message');
        $this->dropTable('relation');
        $this->dropTable('prefix');
        $this->dropTable('news');
        $this->dropTable('manuscript');
        $this->dropTable('link');
        $this->dropTable('file_sample');
        $this->dropTable('file_relationship');
        $this->dropTable('relationship');
        $this->dropTable('file_experiment');
        $this->dropTable('file_attributes');
        $this->dropTable('file');
        $this->dropTable('file_type');
        $this->dropTable('file_format');
        $this->dropTable('external_link');
        $this->dropTable('external_link_type');
        $this->dropTable('exp_attributes');
        $this->dropTable('experiment');
        $this->dropTable('dataset_type');
        $this->dropTable('type');
        $this->dropTable('dataset_session');
        $this->dropTable('dataset_sample');
        $this->dropTable('dataset_project');
        $this->dropTable('project');
        $this->dropTable('dataset_log');
        $this->dropTable('dataset_funder');
        $this->dropTable('funder_name');
        $this->dropTable('dataset_author');
        $this->dropTable('dataset_attributes');
        $this->dropTable('unit');
        $this->dropTable('curation_log');
        $this->dropTable('dataset');
        $this->dropTable('publisher');
        $this->dropTable('image');
        $this->dropTable('author_rel');
        $this->dropTable('author');
        $this->dropTable('attribute');
        $this->dropTable('alternative_identifiers');
        $this->dropTable('sample');
        $this->dropTable('gigadb_user');
        $this->dropTable('species');
        $this->dropTable('extdb');
        $this->dropTable('YiiSession');
        $this->dropTable('AuthAssignment');
        $this->dropTable('AuthItem');
    }
}
