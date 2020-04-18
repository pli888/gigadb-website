<?php

class m200418_114307_subwiz_alter_sample_table_add_description_col extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE sample
            ADD description character varying(100) NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE sample
            DROP description;");
    }
}
