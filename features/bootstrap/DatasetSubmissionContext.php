<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\TableNode;

/**
 * Contains the steps definitions used in author-names.feature and dataset-view.feature
 *
 *
 * @author Rija Menage <rija+git@cinecinetique.com>
 * @license GPL-3.0
 * @see http://docs.behat.org/en/latest/quick_start.html#defining-steps
 *
 * @uses GigadbWebsiteContext For loading production like data
 */
class DatasetSubmissionContext implements Context
{
    private $surname = null;
    private $first_name = null;
    private $middle_name =  null;


    /**
     * @var GigadbWebsiteContext
     */
    private $gigadbWebsiteContext;
    private $minkContext;

    /**
     * The method to retrieve needed contexts from the Behat environment
     *
     * @param BeforeScenarioScope $scope parameter needed to retrieve contexts from the environment
     *
     * @BeforeScenario
     *
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->gigadbWebsiteContext = $environment->getContext('GigadbWebsiteContext');
        $this->minkContext = $environment->getContext('Behat\MinkExtension\Context\MinkContext');
    }

    /**
     * @Then I should see dataset submission :arg1 tab with :arg2 table
     */
    public function iShouldSeeDatasetSubmissionTabWithTable($arg1, $arg2, TableNode $table)
    {
        if ("Author" == $arg1 && "authors" == $arg2) {
//            $this->minkContext->getSession()->getPage()->clickLink($arg1);
            //| First name | Middle name | Last name | ORCiD | CrediT | Order |
            foreach($table as $row) {
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['First name'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Middle name'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Last name'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['ORCiD'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['CrediT'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Order'])
                );
            }
        }
        elseif("Additional Information" == $arg1 && "public_links" == $arg2) {
            //| Link Type | Link |
            foreach($table as $row) {
//                $link = $row['link'];
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Link Type'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Link'])
                );
            }
        }
        elseif("Additional Information" == $arg1 && "related_datasets" == $arg2) {
            //| Relationship | Related DOI |
            foreach($table as $row) {
//                $link = $row['link'];
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Relationship'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Related DOI'])
                );
            }
        }
        elseif("Additional Information" == $arg1 && "collaboration_links" == $arg2) {
            //| Project Name |
            foreach($table as $row) {
//                $link = $row['link'];
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Project Name'])
                );
            }
        }
        elseif("Additional Information" == $arg1 && "other_links_table" == $arg2) {
            print_r("Stuff!!!!:".$table);
            //| Url | Link Description | External Link Type |
            foreach($table as $row) {
//                $link = $row['link'];
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Url'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['Link Description'])
                );
                PHPUnit_Framework_Assert::assertTrue(
                    $this->minkContext->getSession()->getPage()->hasContent($row['External Link Type'])
                );
            }
        }
        else {
            PHPUnit_Framework_Assert::fail("Unknown type of tab");
        }
    }

    /**
     * @When /^I confirm popup$/
     */
    public function iConfirmPopup()
    {
        $this->minkContext->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }






}
