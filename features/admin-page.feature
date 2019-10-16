Feature: GigaDB administration page loading
  In order to make changes to a specific piece of metadata
  As an admin
  I need to view a web page that allows access to various dataset metadata

  Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And default admin user exists

  @ok @admin_page
  Scenario: Loading admin page with all necessary buttons
    Given I sign in as an admin
    When I am on "/site/admin"
    Then I should see a button "Datasets" with link "/adminDataset/admin"
    And I should see a button "Authors" with link "/adminAuthor/admin"
    And I should see a button "Dataset Types" with link "/adminDatasetType/admin"
    And I should see a button "Dataset:Authors" with link "/adminDatasetAuthor/admin"
    And I should see a button "Samples" with link "/adminSample/admin"
    And I should see a button "Data Types" with link "/adminFileType/admin"
    And I should see a button "Dataset:Samples" with link "/adminDatasetSample/admin"
    And I should see a button "Species" with link "/adminSpecies/admin"
    And I should see a button "File Formats" with link "/adminFileFormat/admin"
    And I should see a button "Dataset:Files" with link "/adminFile/admin"
    And I should see a button "Projects" with link "/adminProject/admin"
    And I should see a button "Users" with link "/user/admin"
    And I should see a button "Dataset:Project links" with link "/adminDatasetProject/admin"
    And I should see a button "External Links" with link "/adminExternalLink/admin"
    And I should see a button "Newsletter Subscribers" with link "/user/newsletter"
    And I should see a button "Dataset:Links" with link "/adminLink/admin"
    And I should see a button "Link Prefixes" with link "/adminLinkPrefix/admin"
    And I should see a button "News Items" with link "/news/admin"
    And I should see a button "Dataset:Relations" with link "/adminRelation/admin"
    And I should see a button "Funder" with link "/funder/admin"
    And I should see a button "RSS Messages" with link "/rssMessage/admin"
    And I should see a button "Dataset:Funder" with link "/datasetFunder/admin"
    And I should see a button "Attribute" with link "/attribute/admin"
    And I should see a button "Publishers" with link "/adminPublisher/admin"
    And I should see a button "Dataset:Manuscript" with link "/adminManuscript/admin"
    And I should see a button "Google Analytics" with link "/report/index"
    And I should see a button "Update Logs" with link "/datasetLog/admin"

  @ok @admin_page
  Scenario: Go to Datasets admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Datasets"
    Then I should be on "/adminDataset/admin"
    And I should see a button "Create Dataset" with link "/adminDataset/create"
    And I should see "Genomic data from Adelie penguin (Pygoscelis adeliae)"
    And I should see "Genome data from foxtail millet (Setaria italica)"
    And I should see "Data and software to accompany the paper: Applying compressed sensing to genome-wide association studies"
    And I should see "Supporting scripts and data for \"Investigation into the annotation of protocol sequencing steps in the Sequence Read Archive\""

  @ok @admin_page
  Scenario: Go to Authors admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Authors"
    Then I should be on "/adminAuthor/admin"
    And I should see a button "Create a new author" with link "/adminAuthor/create"
    And I should see "Lambert"
    And I should see "Wang"
    And I should see "Zhang"

  @ok @admin_page
  Scenario: Go to Dataset Type admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset Types"
    Then I should be on "/adminDatasetType/admin"
    And I should see a button "Create A New Dataset Type" with link "/adminDatasetType/create"
    And I should see "genetic and genomic data e.g. sequence and assemblies"
    And I should see "computational tools for analysing and managing biological data"

  @ok @admin_page
  Scenario: Go to Dataset Author admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Authors"
    Then I should be on "/adminDatasetAuthor/admin"
    And I should see a button "Add an author to a Dataset" with link "/adminDatasetAuthor/create"
    And I should see "100002"
    And I should see "Lambert, David"
    And I should see "Wang, Jun"
    And I should see "Zhang, Guojie"

  @ok @admin_page
  Scenario: Go to Samples admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Samples"
    Then I should be on "/adminSample/admin"

  @ok @admin_page
  Scenario: Go to Data Types admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Data Types"
    Then I should be on "/adminFileType/admin"
    And I should see a button "Create A New Data Type" with link "/adminFileType/create"
    And I should see "Readme"
    And I should see "Sequence assembly"
    And I should see "Annotation"

  @ok @admin_page
  Scenario: Go to Dataset Samples admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Samples"
    Then I should be on "/adminDatasetSample/admin"

  @ok @admin_page
  Scenario: Go to Species admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Species"
    Then I should be on "/adminSpecies/admin"
    And I should see a button "Create New Species" with link "/adminSpecies/create"
    And I should see "9238"
    And I should see "Adelie penguin"
    And I should see "None assigned"

  @ok @admin_page
  Scenario: Go to File Formats admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "File Formats"
    Then I should be on "/adminFileFormat/admin"
    And I should see a button "Create A New File Format" with link "/adminFileFormat/create"
    And I should see "FASTA"
    And I should see "The General Feature Format (GFF) is used for describing genes and other features of DNA, RNA and protein sequences"
    And I should see "TEXT"

  @ok @admin_page
  Scenario: Go to Datasets Files admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Files"
    Then I should be on "/adminFile/admin"
    And I should see a button "Create New File" with link "/adminFile/create"
    And I should see a button "Link Temp File Folder" with link "/adminFile/linkFolder"
    And I should see "Pygoscelis_adeliae.cds.gz"
    And I should see "2014-05-12"
    And I should see "Pygoscelis_adeliae.gff.gz"

  @ok @admin_page
  Scenario: Go to Projects admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Projects"
    Then I should be on "/adminProject/admin"
    And I should see a button "Create New Project" with link "/adminProject/create"
    And I should see "http://www.genome10k.org/"
    And I should see "The Avian Phylogenomic Project"

  @ok @admin_page
  Scenario: Go to Users admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Users"
    Then I should be on "/user/admin"
    And I should see "admin@gigadb.org"
    And I should see "Smith"

  @ok @admin_page
  Scenario: Go to Dataset Projects links admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Project links"
    Then I should be on "/adminDatasetProject/admin"
    And I should see a button "Add a Project to a Dataset" with link "/adminDatasetProject/create"
    And I should see "The Avian Phylogenomic Project"
    And I should see "Genome 10K"

  @ok @admin_page
  Scenario: Go to External Links admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "External Links"
    Then I should be on "/adminExternalLink/admin"
    And I should see a button "Create New External Link" with link "/adminExternalLink/create"
    And I should see "Additional information"
    And I should see "https://github.com/ShashaankV/GD"

  @ok @admin_page
  Scenario: Go to Newsletter Subscribers admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Newsletter Subscribers"
    Then I should be on "/user/newsletter"

  @ok @admin_page
  Scenario: Go to Dataset Links admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Links"
    Then I should be on "/adminLink/admin"
    And I should see a button "Create A New Link" with link "/adminLink/create"
    And I should see "Is Primary"

  @ok @admin_page
  Scenario: Go to Link Prefixes admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Link Prefixes"
    Then I should be on "/adminLinkPrefix/admin"
    And I should see a button "Create A New Link Prefix" with link "/adminLinkPrefix/create"
    And I should see "EBI"
    And I should see "http://www.ncbi.nlm.nih.gov/sra?term="

  @ok @admin_page
  Scenario: Go to News Items admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "News Items"
    Then I should be on "/news/admin"
    And I should see a button "Create A News Item For The Home Page" with link "/news/create"
    And I should see "Body"

  @ok @admin_page
  Scenario: Go to Dataset Relations admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Relations"
    Then I should be on "/adminRelation/admin"
    And I should see a button "Create A New Relation" with link "/adminRelation/create"
    And I should see "Relationship Name"

  @ok @admin_page
  Scenario: Go to Funder admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Funder"
    Then I should be on "/funder/admin"
    And I should see a button "Add New Funder" with link "/funder/create"
    And I should see "Primary Name Display"

  @ok @admin_page
  Scenario: Go to RSS Messages admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "RSS Messages"
    Then I should be on "/rssMessage/admin"
    And I should see a button "Create an RSS Message" with link "/rssMessage/create"
    And I should see "Created At"

  @ok @admin_page
  Scenario: Go to Dataset Funder admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Funder"
    Then I should be on "/datasetFunder/admin"
    And I should see a button "Add New Dataset Funders" with link "/datasetFunder/create"
    And I should see "Grant Award"

  @ok @admin_page
  Scenario: Go to Attribute admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Attribute"
    Then I should be on "/attribute/admin"
    And I should see a button "Add New Attribute" with link "/attribute/create"
    And I should see "Source material identifiers"
    And I should see "urltoredirect"

  @ok @admin_page
  Scenario: Go to Publishers admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Publishers"
    Then I should be on "/adminPublisher/admin"
    And I should see a button "Create a new publisher" with link "/adminPublisher/create"
    And I should see "Description"
    And I should see "GigaScience"

  @ok @admin_page
  Scenario: Go to Dataset Manuscript admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Dataset:Manuscript"
    Then I should be on "/adminManuscript/admin"
    And I should see a button "Create A New Manuscript" with link "/adminManuscript/create"
    And I should see "Identifier"

  @ok @admin_page
  Scenario: Go to Google Analytics admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Google Analytics"
    Then I should be on "/report/index"
    And I should see a form element labelled "Report_start_date"
    And I should see a form element labelled "Report_end_date"

  @ok @admin_page
  Scenario: Go to Update Logs admin page
    Given I sign in as an admin
    And I am on "/site/admin"
    When I follow "Update Logs"
    Then I should be on "/datasetLog/admin"
    And I should see a button "Add an update log" with link "/datasetLog/create"
    And I should see "Table Changed"
