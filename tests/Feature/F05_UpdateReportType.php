<?php

namespace Tests\Feature;

use App\Services\DatabaseEnums;

// phpcs:ignore
class F05_UpdateReportType extends F00_GeneralSteps
{
    private static $responseData;

    /**
     * @When /^I change the report type with other valid$/
     */
    public function iChangeTheReportTypeWithOtherValid()
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['reporte_id' => 1, 'tipo' => DatabaseEnums::RT_BASURA];
        $response = $this->put('api/reportes/tipo', $data, $headers);
        $response->assertStatus(200);

        F05_UpdateReportType::$responseData = json_decode(
            $response->baseResponse->content(),
            true
        );
    }

    /**
     * @Then /^I get the updated report details$/
     */
    public function iGetTheUpdatedReportDetails()
    {
        $data = F05_UpdateReportType::$responseData;

        $expectedAttributes = [
            'id',
            'fecha',
            'tipo',
            'lat',
            'lng',
            'direccion',
            'incidencias',
            'estatus'
        ];

        foreach ($expectedAttributes as $attribute) {
            $this->assertArrayHasKey($attribute, $data);
        }

        $this->assertEquals(DatabaseEnums::RT_BASURA, $data['tipo']);
    }

    /**
     * @When /^I change the report type with a non existent one$/
     */
    public function iChangeTheReportTypeWithANonExistentOne()
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['reporte_id' => 1, 'tipo' => 'tipoinvalido'];
        $response = $this->put('api/reportes/tipo', $data, $headers);
        $response->assertStatus(400);
        F05_UpdateReportType::$responseData = $response->baseResponse->original;
    }

    /**
     * @Then /^I get an invalid report type error message$/
     */
    public function iGetAnInvalidReportTypeErrorMessage()
    {
        $data = F05_UpdateReportType::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey('tipo', $data['errors']);
        $this->assertContains(
            'El tipo debe ser alguno de los siguientes: baches, iluminación,' .
            ' basura, seguridad, jiapaz',
            $data['errors']['tipo']
        );
    }
}
