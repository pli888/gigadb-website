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

@add-author-manual @javascript
Scenario: Add an author to a dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/authorManagement/id/300"
    And I fill in "First Name" with "Foo"
    And I fill in "Middle Name (optional)" with "xyzzy"
    And I fill in "Last Name" with "Bar"
    And I fill in "ORCiD (optional)" with "0000-0000-0000-0001"
    And I select "Data curation" from "js-author-contribution"
    And I follow "js-add-author"
    And I wait "3" seconds
    # And I take a screenshot named "authortab"
    Then I should see dataset submission "Author" tab with table
    | First name | Middle name | Last name | ORCiD | CrediT | Order |
    | Foo | xyzzy  | Bar  | 0000-0000-0000-0001 | Data curation | 1 |
    # And I follow "Save"

@add-author-csv @javascript
Scenario: Add an Author via a CSV file to a dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/authorManagement/id/300"
    And I attach the file "/var/www/features/resources/authors_example.csv" to "authors"
    And I follow "js-add-authors"
    And I wait "3" seconds
    # And I take a screenshot named "authortab"
    Then I should see dataset submission "Author" tab with table
    | First name | Middle name | Last name | ORCiD | CrediT | Order |
    | Luke | | Skywalker  | 1212-1212-1212-1212 | Software | 1 |
    | Ben  | Obi-Wan | Kenobi | 2323-2323-2323-2323 | Methodology | 2 |
    | Leia | | Organa  | 4545-4545-4545-4545 | Funding acquisition | 3 |
    # And I press "Save"

@add-author-tsv @javascript @wip
Scenario: Add an Author via a TSV file to a dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/authorManagement/id/300"
    And I attach the file "/var/www/features/resources/authors_example.tsv" to "authors"
    And I follow "js-add-authors"
    And I wait "3" seconds
    And I take a screenshot named "authortab"
    Then I should see dataset submission "Author" tab with table
    | First name | Middle name | Last name | ORCiD | CrediT | Order |
    | Jabba | The | Hutt | 4242-4242-5252-6666 | Project administration | 1 |
    | Supreme | Leader | Snoke | 4242-4242-5252-6667 | Resources | 2 |
    | Darth | | Maul | 4242-4242-5252-6668 | Data curation | 3 |
    # And I press "Save"
