<?php

namespace Tests\Feature\F14_SearchBeneficiary;

use App\Models\BenBeneficiario;
use Tests\Feature\F00_GeneralSteps;

class SearchBeneficiary extends F00_GeneralSteps
{
    private static $originalBen;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        F00_GeneralSteps::$requestData = [];
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        F00_GeneralSteps::$requestData = [];
    }

    /**
     * @Given /^I provide an existent curp$/
     */
    public function iProvideAnExistentCurp()
    {
        $curp = BenBeneficiario::first()->curp;

        SearchBeneficiary::$originalBen = BenBeneficiario::whereCurp($curp)
            ->first()
            ->toArray();

        F00_GeneralSteps::$requestData['curp'] = $curp;
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide an assigned neighborhood$/
     */
    public function iProvideAnAssignedNeighborhood()
    {
        $colonia = BenBeneficiario::first()->colonia;

        SearchBeneficiary::$originalBen = BenBeneficiario::whereColonia(
            $colonia
        )->first()->toArray();

        F00_GeneralSteps::$requestData['colonia'] = $colonia;
        $this->assertTrue(true);
    }

    /**
     * @When /^I search the beneficiary$/
     */
    public function iSearchTheBeneficiary()
    {
        $token = F00_GeneralSteps::$authToken;

        $this->httpPost(
            '/api/beneficiarios/buscar',
            F00_GeneralSteps::$requestData,
            ['Authorization' => "Bearer $token"]
        );

        $this->assertNotNull(F00_GeneralSteps::$responseData);
    }

    /**
     * @Then /^I get the data of the found beneficiary$/
     */
    public function iGetTheDataOfTheFoundBeneficiary()
    {
        $foundBens = F00_GeneralSteps::$responseData;

        $keys = [
            'nombre',
            'primer_apellido',
            'segundo_apellido',
            'sexo',
            'curp',
            'telefono',
            'nombre_vialidad',
            'numero_exterior',
            'numero_interior',
            'colonia'
        ];

        foreach ($foundBens as $ben) {
            $this->assertArrayHasKeys($keys, SearchBeneficiary::$originalBen);
            $this->assertArrayHasKeys($keys, $ben);

            foreach ($keys as $key) {
                $this->assertEquals(
                    SearchBeneficiary::$originalBen[$key],
                    $ben[$key]
                );
            }
        }
    }

    /**
     * @Given /^I provide a non existent curp$/
     */
    public function iProvideANonExistentCurp()
    {
        F00_GeneralSteps::$requestData['curp'] = 'XXXX010101XXXXXX01';
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get a non existent curp error message$/
     */
    public function iGetANonExistentCurpErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'La curp proporcionada no existe',
            'curp'
        );
    }
}
