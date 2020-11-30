@wl-sub-wiz @sample-tab
Feature: Fill in Sample tab when creating a new dataset online
AS an author,
I WANT TO fill in the Sample tab
SO THAT I can provide information about the samples used in my dataset

Background:
    Given Gigadb web site is loaded with "new_gigadb_testdata.pgdmp" data
    And default admin user exists
    And user "joy_fox" is loaded
    And user "subwiz_study" is loaded

@javascript
Scenario: Add species information to sample
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I follow "Add Row"
    And I wait "1" seconds
    #And I update dataset status to "Incomplete" where id is "210"
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "Adelie penguin"
    And I fill in "description" with "foobar"
#    And I follow "Save"
#    And I take a screenshot named "sampletab"
    And I follow "Next"
    And I wait "3" seconds
#    And I take a screenshot named "end"
    Then I should see "All the dataset and sample metadata has been received, thank you."
#    And I should be on "/datasetSubmission/end/id/210"
#    And I press "Return to your profile page"
#    Then I should be on "/user/view_profile/added/210/#submitted"


@javascript
Scenario: Show warning that data in sample table will be over-written when applying template
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I follow "Add Row"
    And I wait "1" seconds
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "Adelie penguin"
    And I fill in "description" with "foobar"
    And I follow "Save"
    And I wait "2" seconds
    And I select "genomic" from "template"
    And I follow "Apply"
    And I wait "2" seconds
    Then I confirm popup
#    And I take a screenshot named "sampletab"
#    Then I should see "Please note that all data in table will be overwritten! Are you sure?"

@javascript
Scenario: Load sample template
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I select "genomic" from "template"
    And I follow "Apply"
    And I wait "2" seconds
    Then I should see dataset submission Sample tab with genomic table
    | Sample ID | Species name | Description | age | life stage | geographic location (country and/or sea,region) | collection date | ploidy | sample collection device or method | sample material processing | amount or size of sample collected | sequencing method | tissue | sample source | alternative accession-BioSample | alternative accession-BioProject | collected by | estimated genome size | isolate | Analyte type | geographic location (latitude) | geographic location (longitude) | cell line | broad-scale environmental context | local environmental context | environmental medium |

@javascript
Scenario: Upload sample metadata file
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I attach the file "/var/www/features/resources/minimal_sample_example.csv" to "samples"
    And I wait "3" seconds
    And I follow "js-add-samples"
    And I wait "3" seconds
    And I follow "Save"
    And I wait "3" seconds
    And I take a screenshot named "samples_tab"
    # Table info below from http://gigadb.org/dataset/100720
    Then I should see dataset submission Sample tab with minimal table
    | Sample ID | Species name | Description |
    # Need to drill into <td><input><div> to access the data below
    # | SRS004381 | Adelie penguin | We sequenced DNA extracted from blood of a 3-year old female panda named Jingjing |

@javascript
    Scenario: Return to profile page after sample tab with submitted dataset highlighted
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I attach the file "/var/www/features/resources/minimal_sample_example.csv" to "samples"
    And I wait "3" seconds
    And I follow "js-add-samples"
    And I wait "3" seconds
    And I follow "Save"
    And I wait "3" seconds
    And I follow "Next"
    And I wait "2" seconds
    And I follow "Return to your profile page"
    Then I should be on "/user/view_profile/added/300/#submitted"

@javascript
Scenario: When Save button is pressed then sample data is displayed in table
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I follow "Add Row"
    And I wait "1" seconds
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "Adelie penguin"
    And I fill in "description" with "foobar"
    And I follow "Save"
    And I wait "2" seconds
    Then I should see dataset submission Sample tab with minimal table
    | Sample ID | Species name | Description |
#    | sample-001 | Adelie penguin | foobar |

@javascript
Scenario: Display error message when sample with same sample ID is used twice
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I follow "Add Row"
    And I wait "1" seconds
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "Adelie penguin"
    And I fill in "description" with "foobar"
    And I follow "Add Row"
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "Adelie penguin"
    And I fill in "description" with "foobar"
    And I follow "Save"
#    Then I confirm popup
#    Then I should see "Row 2: Sample ID already exist."

@javascript
Scenario: User adds an invalid species name and gets notified
    Given I sign in as an admin
    When I go to "/datasetSubmission/sampleManagement/id/300"
    And I follow "Add Row"
    And I wait "1" seconds
    And I fill in "sample-id" with "sample-001"
    And I fill in "species-name" with "foo"
    And I fill in "description" with "bar"
    And I follow "Save"
#    Then I should see "Row 1: Species Name is invalid."





    


