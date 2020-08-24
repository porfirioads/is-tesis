<?php

namespace Tests\Feature\F11_AddSupportRequest;

use App\Models\BenApoyo;
use App\Models\BenSolicitud;
use App\Services\DatabaseEnums;
use Behat\Behat\Tester\Exception\PendingException;
use Illuminate\Support\Facades\Log;
use Tests\Feature\F00_GeneralSteps;

// phpcs:ignore
class F11_AddSupportRequest extends F00_GeneralSteps
{
    private static $supportCount;

    /**
     * @Given /^I provide the complete and correct data for a support request$/
     */
    public function iProvideTheCompleteAndCorrectDataForASupportRequest()
    {
        F11_AddSupportRequest::$supportCount = BenSolicitud::count();

        F00_GeneralSteps::$requestData = [
            'fecha_solicitud' => null,
            'fecha_aceptacion' => null,
            'fecha_entrega' => null,
            'estatus' => DatabaseEnums::BEN_EST_PENDIENTE,
            'monto' => 5000,
            'evidencia' => null,
            'beneficiario_id' => 1,
            'apoyo_secretaria_id' => 1
        ];

        $this->assertTrue(true);
    }

    /**
     * @When /^I register the support request$/
     */
    public function iRegisterTheSupportRequest()
    {
        $token = F00_GeneralSteps::$authToken;

        $this->httpPost(
            '/api/apoyos',
            F00_GeneralSteps::$requestData,
            ['Authorization' => "Bearer $token"]
        );

        $this->assertNotNull(F00_GeneralSteps::$responseData);
    }

    /**
     * @Then /^the support request is registered$/
     */
    public function theSupportRequestIsRegistered()
    {
        $newSupportCount = BenSolicitud::count();
        $this->assertEquals(
            F11_AddSupportRequest::$supportCount + 1,
            $newSupportCount
        );
    }

    /**
     * @Given /^I get the information of the created support request$/
     */
    public function iGetTheInformationOfTheCreatedSupportRequest()
    {
        $responseData = F00_GeneralSteps::$responseData;

        $keys = [
            'id',
            'fecha_solicitud',
            'fecha_aceptacion',
            'fecha_entrega',
            'estatus',
            'monto',
            'evidencia',
            'beneficiario_id',
            'apoyo_secretaria_id'
        ];

        $this->assertArrayHasKeys($keys, $responseData);
    }

    /**
     * @Given /^I do not provide complete data for a support request$/
     */
    public function iDoNotProvideCompleteDataForASupportRequest()
    {
        F11_AddSupportRequest::$supportCount = BenSolicitud::count();

        F00_GeneralSteps::$requestData = [
            'fecha_solicitud' => null,
            'fecha_aceptacion' => null,
            'fecha_entrega' => null,
        ];

        $this->assertTrue(true);
    }

    /**
     * @Then /^the support request is not registered$/
     */
    public function theSupportRequestIsNotRegistered()
    {
        $newSupportCount = BenSolicitud::count();

        $this->assertEquals(
            F11_AddSupportRequest::$supportCount,
            $newSupportCount
        );
    }

    /**
     * @Given /^I get an error support request insertion message$/
     */
    public function iGetAnErrorSupportRequestInsertionMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $keys = ['estatus', 'beneficiario_id', 'apoyo_secretaria_id'];
        $this->assertArrayHasKeys($keys, $responseData['errors']);
    }

    /**
     * @Given /^I provide a beneficiary that not exists in the system$/
     */
    public function iProvideABeneficiaryThatNotExistsInTheSystem()
    {
        F11_AddSupportRequest::$supportCount = BenSolicitud::count();

        F00_GeneralSteps::$requestData = [
            'beneficiario_id' => 1000,
        ];

        $this->assertTrue(true);
    }

    /**
     * @Given /^I get an invalid beneficiary error message$/
     */
    public function iGetAnInvalidBeneficiaryErrorMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('beneficiario_id', $responseData['errors']);
        $this->assertContains(
            'El id debe corresponder a un beneficiario existente',
            $responseData['errors']['beneficiario_id']
        );
    }
}
