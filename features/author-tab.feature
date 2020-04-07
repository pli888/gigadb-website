@wl-sub-wiz @author-tab
Feature: Fill in Author tab when creating a new dataset online
AS an author,
I WANT TO fill in the Author tab
SO THAT I can provide a list of authors for my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

@add-author-manual
Scenario: Add an author to a dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/authorManagement/id/322"
    And I fill in "First Name" with "QA"
    And I fill in "Middle Name" with "test middle name"
    And I fill in "Last Name" with "Engineer"
    And I fill in "ORCiD" with "0000-0000-0000-0001"
    And I fill in "CrediT" with "Conceptualization"
    And I select "CrediT" from "Conceptualization" autocomplete list
    And I press "Add Author" button
    And I press "Save" button
    Then I should see a table
    | First Name | Middle Name | Last name | ORCiD | CRediT |
    | QA | "test middle name"  | Engineer  | 0000-0000-0000-0001 | Conceptualization |

@add-author-csv
Scenario: Add an Author via a CSV file to a dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/authorManagement/id/322"
    And I press "Choose file" to select CSV file
    And I press "Add Authors" button
    And I press "Save" button
    Then I should see a table
    | First Name | Middle Name | Last name | ORCiD | CRediT |
    | L | | Skywalker  | 0000-0000-0000-0002 | Conceptualization |
    | L | | Organa  | 0000-0000-0000-0003 | Conceptualization |

@add-author-tsv
Scenario: Add an Author via a TSV file to a dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/authorManagement/id/322"
    And I press "Choose file" to select TSV file
    And I press "Add Authors" button
    And I press "Save" button
    Then I should see a table
    | First Name | Middle Name | Last name | ORCiD | CRediT |
    | B | | Solo  | 0000-0000-0000-0004 | Conceptualization |
    | R | | Skywalker  | 0000-0000-0000-0005 | Conceptualization |
