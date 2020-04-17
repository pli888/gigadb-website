<?php

class m200416_090958_subwiz_alter_author_table_add_contribution_col extends CDbMigration
{
    public function up()
    {
        $this->execute('ALTER TABLE author
            ADD contribution_id integer NULL;');
    }

    public function down()
    {
        $this->execute('ALTER TABLE author
            DROP COLUMN contribution_id;');
    }
}
