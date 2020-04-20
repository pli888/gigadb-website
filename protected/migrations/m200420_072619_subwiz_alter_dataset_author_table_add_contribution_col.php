<?php

class m200420_072619_subwiz_alter_dataset_author_table_add_contribution_col extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE dataset_author
			ADD contribution_id integer NULL;');
	}

	public function down()
	{
		$this->execute("ALTER TABLE dataset_author
            DROP contribution_id;");
	}
}
