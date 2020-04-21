<?php

class m200417_050712_subwiz_alter_external_link_table_add_cols extends CDbMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE external_link
            ALTER external_link_type_id DROP NOT NULL,
            ADD description character varying(200) NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE external_link
            ALTER external_link_type_id SET NOT NULL,
            DROP description;");
    }
}
