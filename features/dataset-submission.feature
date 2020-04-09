@wl-sub-wiz @dataset-submission-page
Feature: Dataset submission page
AS an author,
I WANT TO choose to upload, or create a new or test dataset
SO THAT I can decide how to provide details about my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

Scenario: Go to Dataset submission page
    Given I am logged in to Gigadb web site
    When I go to "/user/view_profile"
    And I press "Submit new dataset"
    Then I should be on "/datasetSubmission/choose"
    And I should see "Dataset submission"

Scenario: Go to dataset metadata spreadsheet upload page
    Given I am logged in to Gigadb web site
    When I go to "/user/view_profile"
    And I press "Submit new dataset"
    And I press "Upload new dataset from spreadsheet"
    Then I should be on "/datasetSubmission/upload"
    And I should see "Upload your dataset metadata from a spreadsheet"
