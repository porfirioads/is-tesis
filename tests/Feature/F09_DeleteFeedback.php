<?php

namespace Tests\Feature;

use App\Models\SeguimientoReporte;
use Behat\Behat\Tester\Exception\PendingException;

// phpcs:ignore
class F09_DeleteFeedback extends F00_GeneralSteps
{
    public static $responseData;

    private function httpDeleteReport($data, $expected_status)
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->delete('api/reportes/seguimiento', $data, $headers);
        $response->assertStatus($expected_status);
        F09_DeleteFeedback::$responseData = $response->baseResponse->original;
    }

    /**
     * @Given /^there are items in the feedback list$/
     */
    public function thereAreItemsInTheFeedbackList()
    {
        $count = SeguimientoReporte::count();
        $this->assertGreaterThanOrEqual(0, $count);
    }

    /**
     * @When /^I delete a feedback$/
     */
    public function iDeleteAFeedback()
    {
        $data = ['seguimiento_id' => 1];
        $this->httpDeleteReport($data, 200);
    }

    /**
     * @Then /^I get a success feedback deletion message$/
     */
    public function iGetASuccessFeedbackDeletionMessage()
    {
        $data = F09_DeleteFeedback::$responseData;
        $this->assertArrayHasKey('query_status', $data);
        $this->assertEquals(1, $data['query_status']);
    }

    /**
     * @When /^I delete a feedback with missing data$/
     */
    public function iDeleteAFeedbackWithMissingData()
    {
        $this->httpDeleteReport([], 400);
    }

    /**
     * @Then /^I get an error feedback deletion message$/
     */
    public function iGetAnErrorFeedbackDeletionMessage()
    {
        $data = F09_DeleteFeedback::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey('seguimiento_id', $data['errors']);
        $this->assertContains(
            'El id del seguimiento es requerido',
            $data['errors']['seguimiento_id']
        );
    }
}
