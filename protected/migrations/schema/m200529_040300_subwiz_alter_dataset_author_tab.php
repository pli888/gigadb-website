<?php

class m200529_040300_subwiz_alter_dataset_author_tab extends CDbMigration
{
    public function up()
    {
        // @only1chunts says: This relates to the new contribution table
        $this->execute('ALTER TABLE dataset_author
            ADD contribution_id integer NULL;');
    }

    public function down()
    {
        $this->execute("ALTER TABLE dataset_author
            DROP contribution_id;");
    }
}
