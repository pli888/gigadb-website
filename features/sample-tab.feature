@wl-sub-wiz @sample-tab
Feature: Fill in Sample tab when creating a new dataset online
AS an author,
I WANT TO fill in the Sample tab
SO THAT I can provide information about the samples used in my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

Scenario: Add species information to sample
    Given I am logged in to Gigadb web site
    When I go to "datasetSubmission/sampleManagement/id/210"
    #And I update dataset status to "Incomplete" where id is "210"
    And I fill in "Sample ID" with "Sample ID"
    And I fill in "Species name" with "Adelie penguin"
    And I fill in "Description" with "some description about species"
    And I press "Add row"
    And I press "Next"
    And I should be on "/datasetSubmission/end/id/210"
    And I press "Return to your profile page"
    Then I should be on "/user/view_profile/added/210/#submitted"

# need to add templates
Scenario: Show warning that data in sample table will be over-written when applying template
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/sampleManagement/id/210"
    And I select "Genomic/Transcriptomic" from "Choose a template"
    And I press "Apply"
    Then I should see "Please note that all data in table will be overwritten! Are you sure?"

Scenario: Load sample template
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/sampleManagement/id/210"
    And I select "Genomic/Transcriptomic" from "Choose a template"
    And I press "Apply"
    Then I should see a table
    | Sample ID | Species name | Description | Analyte type | Geographic location- latitude | Geographic location- longitude | Geographic location- country and/or sea, region | Alternative accession-BioSample | Alternative names | Source material identifiers | Collection date | Environment- biome | Environment- feature | Isolate | Life stage | Sex | Tissue | Age | IUCN Red List | Sample source | Sample contact | Collected by |

Scenario: Upload sample metadata file
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/sampleManagement/id/210"
    And I attach the file "metadata_file" to "Upload sample metadata"
    And I press "Upload"
    And I press "Save"
    # Table info below from http://gigadb.org/dataset/100720
    Then I should see a table
    | Sample ID | Species name | Description | Analyte type | Geographic location- latitude | Geographic location- longitude | Geographic location- country and/or sea, region | Alternative accession-BioSample | Alternative names | Source material identifiers | Collection date | Environment- biome | Environment- feature | Isolate | Life stage | Sex | Tissue | Age | IUCN Red List | Sample source | Sample contact | Collected by |
    | ephyrA    | "Rhopilema esculentum" | "RNA extracted from mixed tissue of flame jellyish ephyra" | RNA | 40.113 | 124.362 | China:Liaoning | SAMN10687023 |  |  | 2018-04-03 |                                                                                                                       |                      |         | ephyra     |     | mixed  |     |               |               |                |              |

Scenario: Return to profile page after sample tab with submitted dataset highlighted
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/end/id/210"
    And I press "Return to your profile page"
    Then I should be on "/user/view_profile/added/210/#submitted"

Scenario: When Save button is pressed then sample data is displayed in table
    Given I am logged in to Gigadb web site
    When I go to "datasetSubmission/sampleManagement/id/210"
    And I fill in "Sample ID" with "Sample ID"
    And I fill in "Species name" with "Adelie penguin"
    And I fill in "Description" with "some description about species"
    And I press "Save"
    Then I should see a table
    | Sample ID | Species name | Description |
    | Sample ID    | "Adelie penguin" | "some description about species" |

Scenario: Display error message when sample with same sample ID is used twice
    Given I am logged in to Gigadb web site
    When I go to "datasetSubmission/sampleManagement/id/210"
    And I fill in "Sample ID" with "Sample ID"
    And I fill in "Species name" with "Adelie penguin"
    And I fill in "Description" with "some description about species"
    And I press "Add row"
    And I fill in "Sample ID" with "Sample ID"
    And I fill in "Species name" with "Adelie penguin"
    And I fill in "Description" with "some description about species"
    And I press "Add row"
    And I press "Save"
    Then I should see "Row 2: Sample ID already exist."

Scenario: User adds an invalid species name and gets notified
    Given I am logged in to Gigadb web site
    When I go to "datasetSubmission/sampleManagement/id/210"
    And I fill in "Sample ID" with "Sample ID"
    And I fill in "Species name" with "Adelie penguin"
    And I fill in "Description" with "some description about species"
    And I press "Save"
    Then I should see "Row 1: Species Name is invalid."





    


