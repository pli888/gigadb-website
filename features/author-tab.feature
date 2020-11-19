@wl-sub-wiz @author-tab
Feature: Fill in Author tab when creating a new dataset online
AS an author,
I WANT TO fill in the Author tab
SO THAT I can provide a list of authors for my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And default admin user exists
    And user "joy_fox" is loaded
    And user "subwiz_study" is loaded

@add-author-manual @wip @javascript
Scenario: Add an author to a dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/authorManagement/id/300"
    And I fill in "First Name" with "Foo"
    And I fill in "Middle Name (optional)" with "xyzzy"
    And I fill in "Last Name" with "Bar"
    And I fill in "ORCiD (optional)" with "0000-0000-0000-0001"
#    And I select "CrediT" from "Conceptualization" autocomplete list
#    And I press "Add Author"
#    And I press "Save":wq::wq!
    And I take a screenshot named "authortab"
#    Then I should see a table
#    | First Name | Middle Name | Last name | ORCiD | CRediT |
#    | QA | "test middle name"  | Engineer  | 0000-0000-0000-0001 | Conceptualization |

@add-author-csv
Scenario: Add an Author via a CSV file to a dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/authorManagement/id/322"
    And I attach the file "file.csv" to "Choose file"
    And I press "Add Authors"
    And I press "Save"
    Then I should see a table
    | First Name | Middle Name | Last name | ORCiD | CRediT |
    | L | | Skywalker  | 0000-0000-0000-0002 | Conceptualization |
    | L | | Organa  | 0000-0000-0000-0003 | Conceptualization |

@add-author-tsv
Scenario: Add an Author via a TSV file to a dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/authorManagement/id/322"
    And I attach the file "file.tsv" to "Choose file"
    And I press "Add Authors"
    And I press "Save"
    Then I should see a table
    | First Name | Middle Name | Last name | ORCiD | CRediT |
    | B | | Solo  | 0000-0000-0000-0004 | Conceptualization |
    | R | | Skywalker  | 0000-0000-0000-0005 | Conceptualization |
