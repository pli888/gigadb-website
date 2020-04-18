<?php

class m200417_053925_subwiz_alter_prefix_table_add_regexp_col extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE prefix
            ADD regexp character varying(128) NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE prefix
            DROP regexp;");
    }
}
