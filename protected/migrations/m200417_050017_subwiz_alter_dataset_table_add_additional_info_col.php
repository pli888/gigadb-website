<?php

class m200417_050017_subwiz_alter_dataset_table_add_additional_info_col extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE dataset
            ADD additional_information character varying(500) NULL;");
    }

    public function down()
    {
        $this->execute('ALTER TABLE dataset
            DROP COLUMN additional_information;');
    }
}
