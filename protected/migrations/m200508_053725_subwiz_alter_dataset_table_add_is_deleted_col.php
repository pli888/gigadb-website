<?php

class m200508_053725_subwiz_alter_dataset_table_add_is_deleted_col extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE dataset
            ADD is_deleted smallint NULL;");
    }

    public function down()
    {
       $this->execute("ALTER TABLE dataset
            DROP is_deleted;");
    }
}
