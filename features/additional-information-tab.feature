@wl-sub-wiz @additional-information-tab
Feature: Fill in Additional Information tab when creating a new dataset online
AS an author,
I WANT TO fill in the Additional Information tab
SO THAT I can provide more information about my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And default admin user exists
    And user "joy_fox" is loaded
    And user "subwiz_study" is loaded

@public-data-archive-links
Scenario: Dataset has not been submitted to a public repository
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    Then the response should contain "Related GigaDB Datasets"

@public-data-archive-links @javascript
Scenario: Dataset has been submitted to a public repository
    Given I sign in as an admin
    And I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-yes"
    Then I should see a form element labelled "Database"
    And I select "ENA" from "prefix"
    And I should see a form element labelled "Accession number"
    And I fill in "link" with "AF240632"
    And I follow "add-link"
    And I wait "3" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "public_links" table
    | Link Type | Link |
    | ENA | AF240632 |

@public-data-archive-links @javascript
Scenario: Dataset has been submitted to a public repository and test deletion of added accession number
    Given I sign in as an admin
    And I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-yes"
    And I select "ENA" from "prefix"
    And I fill in "link" with "AF240632"
    And I follow "add-link"
    And I wait "3" seconds
    And I follow "delete-link"
    When I confirm popup
    # And I take a screenshot named "addinfo"
    Then I should see "No results found."

@related-gigadb-datasets
Scenario: Dataset is not related to another GigaDB dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    Then I should see "Collaboration links"

@related-gigadb-datasets @javascript
Scenario: Dataset is related to another GigaDB dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-yes"
    And I select "IsIdenticalTo" from "relation"
    And I select "100006" from "dataset_doi"
    And I follow "add-related-doi"
    And I wait "3" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "related_datasets" table
    | Relationship | Related DOI |
    | IsIdenticalTo | 100006 |

@related-gigadb-datasets @javascript
Scenario: Delete related DOI and relationship to related GigaDB datasets
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-yes"
    And I select "IsIdenticalTo" from "relation"
    And I select "100006" from "dataset_doi"
    And I follow "add-related-doi"
    And I wait "3" seconds
    And I follow "delete-related-doi"
    And I confirm popup
    # And I take a screenshot named "addinfo"
    Then I should see "No results found."

@collaboration-link
Scenario: Dataset is not part of a large recognised (international) project
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    Then I should see "Other links"

@collaboration-link @javascript
Scenario: Dataset is part of a large recognised (international) project
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-yes"
    And I select "16" from "project"
    And I follow "add-project"
    And I wait "3" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "collaboration_links" table
    | Project Name |
    | Genome 10K |

@collaboration-link @javascript
Scenario: Delete project link to dataset
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-yes"
    And I select "16" from "project"
    And I follow "add-project"
    And I wait "3" seconds
    And I follow "delete-project"
    And I confirm popup
    # And I take a screenshot named "addinfo"
    Then I should see "No results found."

@other-links @javascript
Scenario: Dataset has no Protocols IO, SketchFab, Code Ocean nor other source
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-no"
    And I follow "protocols-no"
    And I follow "3d_images-no"
    And I follow "codes-no"
    And I follow "repositories-no"
    And I follow "sources-no"
    # And I take a screenshot named "addinfo"
    And I follow "Next"
    And I wait "2" seconds
    # And I take a screenshot named "funding"
    Then I should see "Add Fundings"

@other-links @javascript @sketchfab
Scenario: Dataset is associated with a SketchFab link
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-no"
    And I follow "protocols-no"
    And I follow "3d_images-yes"
    And I fill in "sketchfab-link" with "https://skfb.ly/test"
    And I follow "add-sketchfab-link"
    And I follow "codes-no"
    And I follow "repositories-no"
    And I follow "sources-no"
    And I wait "2" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "other_links_table" table
    | Url | Link Description | External Link Type |
    | https://skfb.ly/test | | 3d image |

@other-links @codeocean @javascript
Scenario: Dataset has executable code in CodeOcean
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-no"
    And I follow "protocols-no"
    And I follow "3d_images-no"
    And I follow "codes-yes"
    And I fill in "codes-link" with "stuff"
    And I follow "add-codes-link"
    And I follow "repositories-no"
    And I follow "sources-no"
    And I wait "2" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "other_links_table" table
    | Url | Link Description | External Link Type |
    | stuff | | code |

@other-links @protocolsio @javascript
Scenario: Dataset is associated with a Protocols.io DOI
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-no"
    And I follow "protocols-yes"
    And I fill in "protocols-link" with "doi:10.17504/protocols.io.888test"
    And I follow "add-protocols-link"
    And I follow "3d_images-no"
    And I follow "codes-no"
    And I follow "sources-no"
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "other_links_table" table
    | Url | Link Description | External Link Type |
    | doi:10.17504/protocols.io.888test | | protocol |
    #Then the protocol url is added and External Link Type is "protocol"
    #When I press Next button on Additional Information tab
    #Then the link 'url' is saved to DB 'external_link' where dataset id is '322'
    #And I delete the saved link from DB 'external_link' where dataset id is '322'

@other-links @manuscripts @javascript
Scenario: Dataset is associated with another manuscript DOI
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-yes"
    And I fill in "manuscripts-link" with "doi:10.1093/gigascience/giy095"
    And I follow "add-manuscripts-link"
    And I follow "protocols-no"
    And I follow "3d_images-no"
    And I follow "codes-no"
    And I follow "sources-no"
    #Then the manuscript url is added and External Link Type is "manuscript"
    #When I press Save button on Additional Information tab
    #Then the link 'identifier' is saved to DB 'manuscript' where dataset id is '322'
    #And I delete the saved link from DB 'manuscript' where dataset id is '322'
    Then I should see dataset submission "Additional Information" tab with "other_links_table" table
    | Url | Link Description | External Link Type |
    | doi:10.1093/gigascience/giy095 | | manuscript |

@other-links @sources @javascript
  Scenario: Dataset is associated with a dataset DOI in another online repository
    Given I sign in as an admin
    When I go to "/datasetSubmission/additionalManagement/id/300"
    And I follow "public-links-no"
    And I follow "related-doi-no"
    And I follow "projects-no"
    And I follow "manuscripts-no"
    And I follow "protocols-no"
    And I follow "3d_images-no"
    And I follow "codes-no"
    And I follow "sources-yes"
    And I fill in "sources-link" with "doi:12.3456/789012.3"
    And I fill in "sources-description" with "test short description"
    And I follow "add-sources-link"
    And I wait "2" seconds
    # And I take a screenshot named "addinfo"
    Then I should see dataset submission "Additional Information" tab with "other_links_table" table
    | Url | Link Description | External Link Type |
    | doi:12.3456/789012.3  | test short description | source |
    #And I delete the saved link from DB 'external_link' where dataset id is '322'
