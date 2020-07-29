<?php

class m200529_040250_subwiz_alter_prefix_tab extends CDbMigration
{
    public function up()
    {
        // @only1chunts says: I did ask for RegEx testing of the input for
        // certain fields so it makes sense to have those regular expressions
        // stored somewhere
        $this->execute("ALTER TABLE prefix
            ADD regexp character varying(128) NULL;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE prefix
            DROP regexp;");
    }
}
