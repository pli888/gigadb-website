<?php

class m200522_042927_subwiz_alter_prefix_table_add_bioproject_regexp extends CDbMigration
{
    public function up()
    {
        $this->execute("UPDATE prefix 
            SET regexp = '/^PRJ[DEN][A-Z]\d+$/' 
            WHERE prefix = 'BioProject';");
    }

    public function down()
    {
        echo "m200522_042927_subwiz_alter_prefix_table_add_bioproject_regexp does not support migration down.\n";
        return false;
    }
}
