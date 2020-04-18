<?php

class m200418_062104_subwiz_alter_dataset_table_add_funding_col extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE dataset
            ADD funding smallint NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE dataset
            DROP funding;");
    }
}
