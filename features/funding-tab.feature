@wl-sub-wiz @funding-tab
Feature: Fill in Funding tab when creating a new dataset online
AS an author,
I WANT TO fill in the Funding tab
SO THAT I can provide information about the funding that was used to generate my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

Scenario: Pressing Next button on Funding tab leads to Sample tab
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/fundingManagement/id/210"
    And I press "No"
    And I press "Next"
    Then I should be on "datasetSubmission/sampleManagement/id/210"

Scenario: Add funding information for dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/fundingManagement/id/210"
    And I press "Yes"
    And I select "Australian Research Council" from "funding_body"
    And I fill in "Program name" with "Fellowship Funding"
    And I fill in "Grant Number" with "AB123456789"
    And I fill in "PI name" with "Bloggs J"
    And I press "Add Link"
    And I press "Save"
    And I should see a table
    | Funding body | Program Name | Grant Number | PI name |
    | "Australian Research Council" | "Fellowship Funding" | "AB123456789" | "Bloggs J" |

Scenario: delete grant from the table
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/fundingManagement/id/210"
    And I press "yes"
    And I select "Australian Research Council" from "funding_body"
    And I fill in "Program name" with "Fellowship Funding"
    And I fill in "Grant Number" with "AB123456789"
    And I fill in "PI name" with "Bloggs J"
    And I press "Add Link"
    And I press "Delete this row"
    And I press "OK"
    Then I should see "No results found."
