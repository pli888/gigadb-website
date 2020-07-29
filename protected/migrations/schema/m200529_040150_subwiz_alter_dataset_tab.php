<?php

class m200529_040150_subwiz_alter_dataset_tab extends CDbMigration
{
    public function up()
    {
        // @only1chunts says: This is just a flag yes/no to tell the wizard
        // whether to display the additional information links section in the
        // wizard or not. The Additional Information links are currently (and
        // presumably still in the WL version) stored in the table called
        // "External_link" with the link_type "Additional Information"
        $this->execute("ALTER TABLE dataset
            ADD additional_information smallint NULL;;");

        // @only1chunts says: just the flag for the wizard, actual funding info
        // should be stored in the dataset_funder table
        $this->execute("ALTER TABLE dataset
            ADD funding smallint NULL;");

        // @only1chunts says: I dont think the value gets used anywhere anyway,
        // but it has to be null-able as the dataset is created before any files
        // are uploaded so we dont know the dataset size?
        $this->execute('ALTER TABLE dataset
            ALTER COLUMN dataset_size DROP NOT NULL;');

        // @only1chunts says: another flag, this time to let the system know its
        // just a test dataset that can be deleted after X month for subwiz
        // practice area
        $this->execute("ALTER TABLE dataset
            ADD is_test smallint NULL,
            ADD creation_date date NULL;");

        // For undo function
        $this->execute("ALTER TABLE dataset
            ADD is_deleted smallint NULL;");
    }

    public function down()
    {
        $this->execute('ALTER TABLE dataset
            DROP COLUMN additional_information;');

        $this->execute("ALTER TABLE dataset
            DROP funding;");

        $this->execute("ALTER TABLE dataset
            ALTER COLUMN dataset_size SET NOT NULL;");

        $this->execute("ALTER TABLE dataset
            DROP is_test,
            DROP creation_date;");

        $this->execute("ALTER TABLE dataset
            DROP is_deleted;");
    }
}
