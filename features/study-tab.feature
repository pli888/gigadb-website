@wl-sub-wiz @study-tab
Feature: Fill in Study tab when creating a new dataset online
AS an author,
I WANT TO fill in the Study tab
SO THAT I can provide basic information about my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

Scenario: User navigates to "Create Dataset"
    Given I am logged in to Gigadb web site
    When I go to "/user/view_profile"
    And I press "Submit new dataset"
    And I press "Create new dataset online using wizard"
    Then I should be on "/datasetSubmission/create1"
    And I should see "Create Dataset"

Scenario: "Submitter" field is auto-filled with username or email address
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/create1"
    Then I should see a form element labelled "email" with submitter's email

Scenario: Display title length warning message
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/create1"
    And I fill in "Title" with "more_than_100_chars_more_than_100_chars_more_than_100_chars_more_than_100_chars_more_than_100_chars_1"
    Then I should see "Warning: Your title is over 100 characters long, you should reduce it if possible."

Scenario: Fill in Study tab form
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/create1"
    And I fill in "GigaScience manuscript" with "GIGA-D-18-00123"
    And I check "Climate"
    And I check "image-upload"
    And I fill in "Title" with "Dataset_title"
    And I fill in "Description" with "test description"
    And I check "I have read GigaDB's Terms and Conditions"
    And I press "Save"
    And I press "Next"
    #And A new dataset is created in DB table dataset
    Then I should be on "/datasetSubmission/authorManagement"

Scenario: Validate "Type" and "Title" required fields for dataset creation
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/create1"
    And I check "image-upload"
    And I check "I have read GigaDB's Terms and Conditions"
    And I press "Save"
    Then I should see "Types cannot be blank."
    And I should see "Title cannot be blank."

Scenario: Validate required image upload fields for dataset creation
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/create1"
    And I check "Climate"
    And I fill in "Title" with "Dataset_title"
    And I fill in "Description" with "test description"
    And I attach the file "1200per800" to "Image Upload"
    And I check "I have read GigaDB's Terms and Conditions"
    And I press "Save"
    Then I should see "Image License cannot be blank."
    And I should see "Image Credit cannot be blank."
    And I should see "Image Source cannot be blank."

# WL wanted to test image upload by checking the path to the image was
# inserted into the dataset table. This is not a good idea as this
# outcome cannot be inspected so this scenario has been commented out.
#Scenario: Test image upload
#    Given I am logged in to Gigadb web site
#    When I go to "/datasetSubmission/datasetManagement/id/210"
#    And I attach the file "1200per800" to "Image Upload"
#    And I fill in "Image Title" with "Test_image_title"
#    And I select "Public Domain" for "Image Licence"
#    And I fill in "Image Credit" with "mam"
#    And I fill in "Image Source" with "wiki"
#    And I press "Save" button
#    Then the file is properly saved into DB where dataset id is "210"
