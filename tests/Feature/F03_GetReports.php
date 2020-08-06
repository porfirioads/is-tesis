<?php

namespace Tests\Feature;

use App\Models\Reporte;
use Behat\Behat\Context\Context;
use Tests\DatabaseTestCase;

// phpcs:ignore
class F03_GetReports extends DatabaseTestCase implements Context
{
    private static $reports;
    private static $authToken;

    /**
     * @Given /^the reports list has items$/
     */
    public function theReportsListHasItems()
    {
        $reportes = Reporte::all();
        $this->assertGreaterThanOrEqual(1, count($reportes));
    }

    /**
     * @When /^the reports list is returned$/
     */
    public function theReportsListIsReturned()
    {
        $token = F03_GetReports::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->get('api/reportes', $headers);
        $response->assertStatus(200);
        F03_GetReports::$reports = $response->baseResponse->original;
        $this->assertNotNull(F03_GetReports::$reports);
    }

    /**
     * @Then /^each element has the "([^"]*)" attribute$/
     */
    public function eachElementHasTheAttribute($attributeName)
    {
        foreach (F03_GetReports::$reports as $report) {
            $this->assertArrayHasKey($attributeName, $report);
        }
    }

    /**
     * @Given /^I am logged as an admin$/
     */
    public function iAmLoggedAsAnAdmin()
    {
        F03_GetReports::$authToken = null;
        $data = ['username' => 'porfirioads', 'password' => 'porfirioads'];
        $response = $this->post('api/login', $data);
        $response->assertStatus(200);
        $responseData = $response->baseResponse->original;
        F03_GetReports::$authToken = $responseData['token'];
        $this->assertNotNull(F03_GetReports::$authToken);
    }
}
