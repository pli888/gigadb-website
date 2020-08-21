<?php

class m200529_040200_subwiz_alter_external_link_tab extends CDbMigration
{
    public function up()
    {
        // @only1chunts says: We want to be able to add user defined
        // descriptions to the links to display on the dataset pages. #61 github
        // issue
        $this->execute("ALTER TABLE external_link
            ADD description character varying(200) NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE external_link
            DROP description;");
    }
}
