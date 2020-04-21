<?php

class m200421_062752_subwiz_alter_dataset_table_dataset_size_col_null extends CDbMigration
{
    public function up()
    {
        $this->execute('ALTER TABLE dataset
            ALTER COLUMN dataset_size DROP NOT NULL;');
    }

    public function down()
    {
        $this->execute("ALTER TABLE dataset
            ALTER COLUMN dataset_size SET NULL;");
    }
}
