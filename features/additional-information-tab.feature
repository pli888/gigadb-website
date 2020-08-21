@wl-sub-wiz @additional-information-tab
Feature: Fill in Additional Information tab when creating a new dataset online
AS an author,
I WANT TO fill in the Additional Information tab
SO THAT I can provide more information about my dataset

Background:
    Given Gigadb web site is loaded with "gigadb_testdata.pgdmp" data
    And user "joy_fox" is loaded

@public-data-archive-links
Scenario: Dataset has not been submitted to a public repository
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    Then the response should contain "Related GigaDB Datasets"

@public-data-archive-links
Scenario: Dataset has been submitted to a public repository
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    When I press "Yes" button for "Public data archive links"
    Then I should see a form element labelled "Database"

@public-data-archive-links
Scenario: Dataset has been submitted to a public repository and test database is selectable and dropdown accession number field appears
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "Yes" button for "Public data archive links"
    And I select "AE" from "Database"
    Then I should see a form element labelled "Accession number"

@public-data-archive-links
Scenario: Dataset has been submitted to a public repository and test entry of an accession number
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "Yes" button for "Public data archive links"
    And I select "AE" from "Database"
    And I fill in "Accession number" with "E-MEXP-31"
    And I press "Add Link" button
    Then I should see a table
    | Link Type | Link |
    | "Array Express" | E-MEXP-31 |

@public-data-archive-links
Scenario: Dataset has been submitted to a public repository and test deletion of added accession number
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "Yes" button for "Public data archive links"
    And I select "AE" from "Database"
    And I fill in "Accession number" with "E-MEXP-31"
    And I press "Add Link" button
    And I press "Delete this row" button
    And I see an alert "Are you sure you want to delete this item?"
    And I press "OK" button
    Then I should see "No results found."
    And I should see a table
    | Link Type | Link |

@related-gigadb-datasets
Scenario: Dataset is not related to another GigaDB dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    Then I should see "Collaboration links"

@related-gigadb-datasets
Scenario: Dataset is related to another GigaDB dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "Yes button for "Related GigaDB Datasets"
    Then I should see "Add Related Doi" button

@related-gigadb-datasets
Scenario: Dataset is related to another GigaDB dataset and its DOI is added
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "Yes button for "Related GigaDB Datasets"
    And I select "cites" from relationship dropdown list
    And I select "100321" from relation doi dropdown list
    And I press "Add Related Doi"
    Then I should see a table
    | Related DOI | Relationship |
    | 100321 | "isCitedBy this dataset" |

@related-gigadb-datasets
Scenario: Delete related DOI and relationship to related GigaDB datasets
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "Yes button for "Related GigaDB Datasets"
    And I select "cites" from relationship dropdown list
    And I select "100321" from relation doi dropdown list
    And I press "Add Related Doi"
    And I press "Delete this row"
    And I see an alert "Are you sure you want to delete this item?"
    And I press "OK" button
    Then I should see "No results found."
    And I should see a table
    | Related DOI | Relationship |

@collaboration-link
Scenario: Dataset is not part of a large recognised (international) project
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    Then I should see "Other links"

@collaboration-link
Scenario: Dataset is part of a large recognised (international) project
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No button for "Related GigaDB Datasets"
    And I press "Yes" button for "Project links"
    Then I should see "Add Project" button
    And I should see a form element labelled "project"

@collaboration-link
Scenario: Link selected project to dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No button for "Related GigaDB Datasets"
    And I press "Yes" button for "Project links"
    And I select "2" from projects dropdown list
    And I press "Add Project" button
    Then I should see a table
    | Project Name |
    | 2 |

@collaboration-link
Scenario: Delete project link to dataset
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No button for "Related GigaDB Datasets"
    And I press "Yes" button for "Project links"
    And I select "2" from projects dropdown list
    And I press "Add Project" button
    And I press "Delete this row" button
    And I see an alert "Are you sure you want to delete this item?"
    And I press "OK" button
    Then I should see "No results found."
    And I should see a table
    | Project Name |

@other-links
Scenario: Dataset is not associated with a Protocol IO, SketchFab, CodeOcean link nor another dataset stored from another repository
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "No" button for "A published manuscript that uses this data"
    And I press "No" button for "Protocols.io link to methods used to generate this data"
    And I press "No" button for "SketchFab 3d-Image viewer links"
    And I press "No" button for "Actionable code in CodeOceans"
    And I press "No" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I see active "Next" button class "btn btn-green js-save-additional"
    And I press "Next" button
    Then I should see "Funding" tab with text "Would you like to acknowledge any funding bodies that have provided resources to generate these data?"

@other-links @sketchfab
Scenario: Dataset is associated with a SketchFab link
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "No" button for "A published manuscript that uses this data"
    And I press "No" button for "Protocols.io link to methods used to generate this data"
    And I press "Yes" button for "SketchFab 3d-Image viewer links"
    And I fill in "SketchFab link" with "https://skfb.ly/69wDV"
    And I press "No" button for "Actionable code in CodeOcean"
    And I press "No" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I press "Add Link" button
    #And the sketch fab url is added and External Link Type is "3d image"
    When I press "Next" button
    #Then the link 'url' is saved to DB 'external_link' where dataset id is '322'
    #And I delete the saved link from DB 'external_link' where dataset id is '322'
    Then I should see a table
    | Url | External Link Type |
    | https://skfb.ly/69wDV | SketchFab |

@other-links @codeocean
Scenario: Dataset has executable code in CodeOcean
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "No" button for "A published manuscript that uses this data"
    And I press "No" button for "Protocols.io link to methods used to generate this data"
    And I press "No" button for "SketchFab 3d-Image viewer links"
    And I press "Yes" button for "Actionable code in CodeOcean"
    And I fill in "CodeOcean link" with "<script src="https://codeocean.com/widget.js?id=0a812d9b-0ff3-4eb7-825f-76d3cd049a43" async></script>"
    And I press "No" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I press "Add Link" button
    #Then the CodeOcean is added and External Link Type is "code"
    #And I press "Save" button
    #hen the link 'url' is saved to DB 'external_link' where dataset id is '322'
    #And I delete the saved link from DB 'external_link' where dataset id is '322'
    Then I should see a table
    | Url | External Link Type |
    | "<script src="https://codeocean.com/widget.js?id=0a812d9b-0ff3-4eb7-825f-76d3cd049a43" async></script>" | CodeOcean |

@other-links @protocolsio
Scenario: Dataset is associated with a Protocols.io DOI
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "No" button for "A published manuscript that uses this data"
    And I press "Yes" button for "Protocols.io link to methods used to generate this data"
    And I fill in "Protocols.io DOI" with "doi:10.17504/protocols.io.gk8buzw"
    And I press "No" button for "SketchFab 3d-Image viewer links"
    And I press "No" button for "Actionable code in CodeOceans"
    And I press "No" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I press "Add Link" button
    #Then the protocol url is added and External Link Type is "protocol"
    #When I press Next button on Additional Information tab
    #Then the link 'url' is saved to DB 'external_link' where dataset id is '322'
    #And I delete the saved link from DB 'external_link' where dataset id is '322'
    Then I should see a table
    | Url | External Link Type |
    | "doi:10.17504/protocols.io.gk8buzw" | Protocols.io DOI |

@other-links @doi-or-url
Scenario: Dataset is associated with another manuscript DOI
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for "Public data archive links"
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "Yes" button for "A published manuscript that uses this data"
    And I fill in "manuscript link" with "doi:10.1093/gigascience/giy095"
    And I press "No" button for "Protocols.io link to methods used to generate this data"
    And I press "No" button for "SketchFab 3d-Image viewer links"
    And I press "No" button for "Actionable code in CodeOceans"
    And I press "No" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I press Add Link button
    #Then the manuscript url is added and External Link Type is "manuscript"
    #When I press Save button on Additional Information tab
    #Then the link 'identifier' is saved to DB 'manuscript' where dataset id is '322'
    #And I delete the saved link from DB 'manuscript' where dataset id is '322'
    Then I should see a table
    | Url | External Link Type |
    | "doi:10.1093/gigascience/giy095"  | manuscript link |

@other-links @doi-or-url
  Scenario: Dataset is associated with a dataset DOI in another online repository
    Given I am logged in to Gigadb web site
    When I go to "/datasetSubmission/additionalManagement/id/322"
    And I press "No" button for Public data archive links
    And I press "No" button for "Related GigaDB Datasets"
    And I press "No" button for "Project links"
    And I press "No" button for "A published manuscript that uses this data"
    And I press "No" button for "Protocols.io link to methods used to generate this data"
    And I press "No" button for "SketchFab 3d-Image viewer links"
    And I press "No" button for "Actionable code in CodeOceans"
    And I press "Yes" button for "or any other URL to a stable source of data and files directly related to this dataset"
    And I fill in "DOI or URL" with "doi:12.3456/789012.3"
    #And I fill in "short description" with "test short description"
    And I press "Add Link" button
    #Then the DOI or URL is added, Short Description is added and External Link Type is "source"
    #When I press Save button on Additional Information tab
    #Then the link 'url' is saved to DB 'external_link' where dataset id is '322'
    #And I delete the saved link from DB 'external_link' where dataset id is '322'
    Then I should see a table
    | Url | External Link Type |
    | "doi:12.3456/789012.3"  | "DOI or URL" |
