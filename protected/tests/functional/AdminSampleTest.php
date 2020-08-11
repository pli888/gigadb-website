<?php
/**
 * Functional test for the adminSample view classes
 *
 * Currently just tests that sample attributes are displayed
 * in the admin page.
 *
 * @author PeterLi <peter+git@gigasciencejournal.com>
 * @license GPL-3.0
 */
class AdminSampleTest extends FunctionalTesting
{

    use BrowserSignInSteps;
    use BrowserPageSteps;

    /**
     *
     * @uses \BrowserSignInSteps::loginToWebSiteWithSessionAndCredentialsThenAssert()
     */
    public function setUp()
    {
        parent::setUp();
        $this->loginToWebSiteWithSessionAndCredentialsThenAssert("admin@gigadb.org","gigadb","Admin");
    }

    /**
     * Admin page for managing samples should display sample attributes
     *
     * @uses \BrowserPageSteps::visitPageWithSessionAndUrlThenAssertContentHasOrNull()
     * @uses \BrowserPageSteps::assertPageHasContent()
     */
    public function testItShouldDisplaySampleAttributes() {
        $url = "http://gigadb.dev/adminSample/admin" ;
        // Confirm we are on admin page for samples
        $this->visitPageWithSessionAndUrlThenAssertContentHasOrNull($url, "Manage Samples");
        // Confirm we can see an expected sample attribute
        $this->assertPageHasContent('="David Lambert & BGI"');
    }
}

?>

