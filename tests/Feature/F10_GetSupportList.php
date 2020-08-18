<?php

namespace Tests\Feature;

use App\Models\BenSolicitud;
use Illuminate\Support\Facades\Log;

// phpcs:ignore
class F10_GetSupportList extends F00_GeneralSteps
{

    /**
     * @Given /^there are items in the support list$/
     */
    public function thereAreItemsInTheSupportList()
    {
        $this->assertGreaterThanOrEqual(0, BenSolicitud::count());
    }

    /**
     * @When /^the support list is returned$/
     */
    public function theSupportListIsReturned()
    {
        $token = F00_GeneralSteps::$authToken;

        $this->httpGet(
            '/api/apoyos',
            200,
            [],
            ['Authorization' => "Bearer $token"]
        );

        $this->assertNotNull(F00_GeneralSteps::$responseData);
    }

    /**
     * @Then /^each element has the beneficiary information$/
     */
    public function eachElementHasTheBeneficiaryInformation()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        $beneficiarioKeys = [
            'id',
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

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('beneficiario', $beneficiario);
            $this->assertArrayHasKeys($beneficiarioKeys, $beneficiario['beneficiario']);
        }
    }

    /**
     * @Given /^each element has the support type$/
     */
    public function eachElementHasTheSupportType()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('apoyo_secretaria', $beneficiario);
            $this->assertArrayHasKey('tipo_apoyo', $beneficiario['apoyo_secretaria']);
        }
    }

    /**
     * @Given /^each element has the support amount$/
     */
    public function eachElementHasTheSupportAmount()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('monto', $beneficiario);
        }
    }

    /**
     * @Given /^each element has the request date$/
     */
    public function eachElementHasTheRequestDate()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('fecha_solicitud', $beneficiario);
        }
    }

    /**
     * @Given /^each element has the acceptance date$/
     */
    public function eachElementHasTheAcceptanceDate()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('fecha_aceptacion', $beneficiario);
        }
    }

    /**
     * @Given /^each element has the delivery date$/
     */
    public function eachElementHasTheDeliveryDate()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('fecha_entrega', $beneficiario);
        }
    }

    /**
     * @Given /^each element has status attribute$/
     */
    public function eachElementHasStatusAttribute()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;

        foreach ($beneficiarios as $beneficiario) {
            $this->assertArrayHasKey('estatus', $beneficiario);
        }
    }

    /**
     * @Given /^the support list is empty$/
     */
    public function theSupportListIsEmpty()
    {
        BenSolicitud::where('id', '>=', 1)->delete();
        $this->assertDatabaseCount((new BenSolicitud())->getTable(), 0);
    }

    /**
     * @Then /^I cannot see any support$/
     */
    public function iCannotSeeAnySupport()
    {
        $beneficiarios = F00_GeneralSteps::$responseData;
        Log::info(gettype($beneficiarios));
        Log::info($beneficiarios);
        $this->assertCount(0, $beneficiarios);
    }
}
