<?php
	foreach($this->getFixtures() as $tableName=>$fixturePath)
	{
		print_r("\nresetting: $tableName\n");
		$this->resetTable($tableName);
		//$this->loadFixture($tableName);
	}
	$this->loadFixture("rss_message");
	$this->loadFixture("author");
	$this->loadFixture("publisher");
	$this->loadFixture("dataset");
	$this->loadFixture("dataset_author");

	$this->loadFixture("attribute");
	$this->loadFixture("dataset_attributes");
	$this->loadFixture("link");
	$this->loadFixture("prefix");

	$this->loadFixture("type");
	$this->loadFixture("dataset_type");

	$this->loadFixture("file_format");
	$this->loadFixture("file_type");
	$this->loadFixture("contribution");  // Added by WL
	$this->loadFixture("funder_name");  // Added by WL

    $this->loadFixture("species");  // Added by WL
	// $this->loadFixture("file");
    $this->loadFixture("sample");  // Added by WL
	// $this->loadFixture("file_sample");
?>
