<?php

class m200428_050127_subwiz_alter_dataset_table_add_cols_practice_area extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE dataset
            ADD is_test smallint NULL,
            ADD creation_date date NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE dataset
            DROP is_test,
            DROP creation_date;");
    }
}
