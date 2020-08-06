<?php

namespace Tests\Feature;

class F06_DeleteReport extends F00_GeneralSteps
{
    private static $responseData;

    private function deleteReport($reporte_id, $expected_status)
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['reporte_id' => $reporte_id];
        $response = $this->delete('api/reportes', $data, $headers);
        $response->assertStatus($expected_status);
        F06_DeleteReport::$responseData = $response->baseResponse->original;
    }

    /**
     * @When /^I delete a report$/
     */
    public function iDeleteAReport()
    {
        $this->deleteReport(1, 200);
    }

    /**
     * @Then /^I get a success report deletion message$/
     */
    public function iGetASuccessReportDeletionMessage()
    {
        $data = F06_DeleteReport::$responseData;
        $this->assertArrayHasKey('query_status', $data);
        $this->assertEquals(1, $data['query_status']);
    }

    /**
     * @When /^I delete a report that not exists$/
     */
    public function iDeleteAReportThatNotExists()
    {
        $this->deleteReport(19999, 400);
    }

    /**
     * @Then /^I get an error report deletion message$/
     */
    public function iGetAnErrorReportDeletionMessage()
    {
        $data = F06_DeleteReport::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey('reporte_id', $data['errors']);
        $this->assertContains(
            'El id debe corresponder a un reporte existente',
            $data['errors']['reporte_id']
        );
    }
}
