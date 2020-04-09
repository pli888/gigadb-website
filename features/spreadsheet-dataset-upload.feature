@wl-sub-wiz @spreadsheet-dataset-upload
Feature: Upload your dataset metadata from a spreadsheet page
AS an author,
I WANT TO upload dataset metadata from a spreadsheet
SO THAT I can provide information about my dataset

Background:
   Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
   And user "joy_fox" is loaded

# WL did not finish writing this acceptance test
Scenario: Upload dataset metadata with an Excel spreadsheet
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/upload"
    And I check "I have read Terms and Conditions"
    And I attach the file "spreadsheet.xls" to "Excel File"
    And I press "Upload new dataset from spreadsheet"
    And I press "Upload New Dataset"
#    Then send email to database@gigasciencejournal.com with file as attachment NB- subject and body of email are already defined, check should be in place to ensure they are not empty.

