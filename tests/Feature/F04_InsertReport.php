<?php

namespace Tests\Feature;

use App\Services\DatabaseEnums;
use Behat\Behat\Tester\Exception\PendingException;
use Illuminate\Http\UploadedFile;

class F04_InsertReport extends F00_GeneralSteps
{
    private static $responseData;

    /**
     * @When /^I make a report with the correct data$/
     */
    public function iMakeAReportWithTheCorrectData()
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];

        $data = [
            'tipo' => DatabaseEnums::RT_BACHES,
            'lat' => 22.7720023,
            'lng' => -102.6583219,
            'foto' => UploadedFile::fake()->image('foto.png')
        ];

        $response = $this->post('api/reportes', $data, $headers);
        $response->assertStatus(200);
        F04_InsertReport::$responseData = $response->baseResponse->original;
    }

    /**
     * @Then /^I get the information of the report\.$/
     */
    public function iGetTheInformationOfTheReport()
    {
        $data = F04_InsertReport::$responseData;
        $this->assertArrayHasKey('reporte_id', $data);
        $this->assertIsNumeric($data['reporte_id']);
        $this->assertArrayHasKey('incidencia_id', $data);
        $this->assertIsNumeric($data['incidencia_id']);
        $this->assertArrayHasKey('reincidencia', $data);
        $this->assertIsBool($data['reincidencia']);
    }

    /**
     * @When /^I make a report with missing data$/
     */
    public function iMakeAReportWithMissingData()
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = [];
        $response = $this->post('api/reportes', $data, $headers);
        $response->assertStatus(400);
        F04_InsertReport::$responseData = $response->baseResponse->original;
    }

    /**
     * @Then /^I get a report insertion error message\.$/
     */
    public function iGetAReportInsertionErrorMessage()
    {
        $data = F04_InsertReport::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $expectedAttributes = ['tipo', 'lat', 'lng', 'foto'];

        foreach ($expectedAttributes as $attribute) {
            $this->assertArrayHasKey($attribute, $data['errors']);
        }
    }
}
