<?php

namespace Tests\Feature;

use App\Models\Reporte;
use App\Services\DatabaseEnums;
use Behat\Behat\Tester\Exception\PendingException;

// phpcs:ignore
class F08_InsertFeedback extends F00_GeneralSteps
{
    public static $responseData;

    private function httpInsertFeedback($data, $expectedStatus)
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->post('api/reportes/seguimiento', $data, $headers);
        $response->assertStatus($expectedStatus);
        F08_InsertFeedback::$responseData = $response->baseResponse->original;
    }

    /**
     * @Given /^there are items in the reports list$/
     */
    public function thereAreItemsInTheReportsList()
    {
        $reportsCount = Reporte::count();
        $this->assertGreaterThanOrEqual(0, $reportsCount);
    }

    /**
     * @When /^I insert feedback for a report$/
     */
    public function iInsertFeedbackForAReport()
    {
        $data = [
            'reporte_id' => 1,
            'estatus' => DatabaseEnums::RE_CANCELADO,
            'mensaje' => 'Tu reporte no es claro',
        ];

        $this->httpInsertFeedback($data, 200);
    }

    /**
     * @Then /^I get the inserted feedback details$/
     */
    public function iGetTheInsertedFeedbackDetails()
    {
        $data = F08_InsertFeedback::$responseData;

        $expectedFields = [
            'reporte_id',
            'estatus',
            'mensaje',
            'fecha',
            'notificado',
            'id'
        ];

        foreach ($expectedFields as $attribute) {
            $this->assertArrayHasKey($attribute, $data);
        }
    }

    /**
     * @When /^I insert feedback with missing data$/
     */
    public function iInsertFeedbackWithMissingData()
    {
        $this->httpInsertFeedback([], 400);
    }

    /**
     * @Then /^I get an error feedback insertion error message$/
     */
    public function iGetAnErrorFeedbackInsertionErrorMessage()
    {
        $data = F08_InsertFeedback::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $expectedAttributes = ['estatus', 'mensaje', 'reporte_id'];

        foreach ($expectedAttributes as $attribute) {
            $this->assertArrayHasKey($attribute, $data['errors']);
        }
    }

    /**
     * @When /^I insert feedback for a non existent report$/
     */
    public function iInsertFeedbackForANonExistentReport()
    {
        $this->httpInsertFeedback([], 400);
    }
}
