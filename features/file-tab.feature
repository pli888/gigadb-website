@wl-sub-wiz @file-tab
Feature: Fill in File tab when creating a new dataset online
AS an author,
I WANT TO fill in the File tab
SO THAT I can provide information about the files in my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

#  This scenario has been commented out by WL
#  Scenario: the user is redirected to File tab when clicking Update button for a dataset that has status is UserUploadingData
#    Given I am on "site/login" and I login
#    When I go to submission wizard "/user/view_profile#submitted" URL
#    And a dataset with status “UserUploadingData” is included in my user account
#    And I click Update button on dataset id "210"
#    Then the user is redirected to "File details" page
#    need an id with stutus UserUploadingData on DEV

Scenario: Get file names from FTP server, adds the description saves files into DB by clicking Save button
    Given I am logged in to Gigadb web site
    When I go to "/adminFile/create1/id/210"
    And I fill in "FTP username" with "user99"
    And I fill in "FTP password" with "WhiteLabel"
    And I press "Get File Names"
    And I fill in "Description" with "some description about file"
    And I press "Save"
    Then I should see a table
    | File Name | Data Type | File Format | Size | Description | Sample ID |
    | readme.txt | readme.txt | TEXT | 0 KB | "some description about file" | stuff |

Scenario: Show error message when file does not have a description
    Given I am logged in to Gigadb web site
    When I go to "/adminFile/create1/id/210"
    And I press "delete description"
    And I press "Complete submission"
    Then I should see "Description cannot be blank."

Scenario: User is redirected to congratulation page after submitting dataset
    Given I am logged in to Gigadb web site
    And I go to "/adminFile/create1/id/210"
    And I fill in "FTP username" with "user99"
    And I fill in "FTP password" with "WhiteLabel"
    And I press "Get File Names"
    And I fill in "Description" with "some description about file"
    And I press "Complete submission"
    Then I should be on "/datasetSubmission/congratulation"

Scenario: Provide file metadata using CSV/TSV file
    Given I am logged in to Gigadb web site
    When I go to "/adminFile/create1/id/210"
    And I fill in "FTP username" with "user99"
    And I fill in "FTP password" with "WhiteLabel"
    And I press "Get File Names"
    And I attach the file "file_metadata" to "file_metadata_upload"
    And I press "Upload"
    And I press "Save"
    Then I should see a table
    | File Name | Data Type | File Format | Size | Description | Sample ID |
    | readme.txt | readme.txt | TEXT | 0 KB | stuff | stuff |

