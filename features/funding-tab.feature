@wl-sub-wiz @funding-tab
Feature: Fill in Funding tab when creating a new dataset online
AS an author,
I WANT TO fill in the Funding tab
SO THAT I can provide information about the funding that was used to generate my dataset

Background:
    Given Gigadb web site is loaded with "new_gigadb_testdata.pgdmp" data
    And default admin user exists
    And user "joy_fox" is loaded
    And user "subwiz_study" is loaded
    
Scenario: Pressing Next button on Funding tab leads to Sample tab
    Given I sign in as an admin
    When I go to "/datasetSubmission/fundingManagement/id/300"
    And I follow "funding-no-button"
    And I follow "Next"
    Then I should be on "/datasetSubmission/sampleManagement/id/300"
    
@javascript @wip
Scenario: Add funding information for dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/fundingManagement/id/300"
    And I follow "funding-yes-button"
    And I select "AEG Foundation" from "funder_id"
    And I fill in "program_name" with "Fellowship Funding"
    And I fill in "grant" with "AB123456789"
    And I fill in "pi_name" with "Bloggs J"
    And I follow "add-funding"
    And I wait "2" seconds
#    And I press "Save"
    Then I should see dataset submission Funding tab with funding table
    | Funding body | Program Name | Grant Number | PI name |
    | AEG Foundation | Fellowship Funding | AB123456789 | Bloggs J |

Scenario: Delete grant from the table
    Given I sign in as an admin
    When I go to "/datasetSubmission/fundingManagement/id/300"
    And I follow "funding-yes-button"
    And I select "AEG Foundation" from "funder_id"
    And I fill in "program_name" with "Fellowship Funding"
    And I fill in "grant" with "AB123456789"
    And I fill in "pi_name" with "Bloggs J"
    And I follow "add-funding"
    And I wait "2" seconds
    And I follow "delete-funding"
    And I confirm popup
    Then I should see "No results found."
