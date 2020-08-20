<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

use App\Models\BenSolicitud;
use App\Services\DatabaseEnums;
use Carbon\Carbon;
use Log;
use Tests\Feature\F00_GeneralSteps;

// phpcs:ignore
class UpdateSupportRequestStatus extends F00_GeneralSteps
{
    private static $originalSupportRequest;

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
     * @Given /^I provide a valid support request$/
     */
    public function iProvideAValidSupportRequest()
    {
        F00_GeneralSteps::$requestData['solicitud_id'] = 1;

        UpdateSupportRequestStatus::$originalSupportRequest =
            BenSolicitud::find(F00_GeneralSteps::$requestData['solicitud_id']);

        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid approval date$/
     */
    public function iProvideAValidApprovalDate()
    {
        F00_GeneralSteps::$requestData['fecha_aceptacion'] =
            Carbon::now()->format('Y-m-d H:i:s');
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide the approved status$/
     */
    public function iProvideTheApprovedStatus()
    {
        F00_GeneralSteps::$requestData['estatus']
            = DatabaseEnums::BEN_EST_APROBADO;
        $this->assertTrue(true);
    }

    /**
     * @When /^I change the status of the support request$/
     */
    public function iChangeTheStatusOfTheSupportRequest()
    {
        $token = F00_GeneralSteps::$authToken;

        $this->httpPut(
            '/api/apoyos',
            F00_GeneralSteps::$requestData,
            ['Authorization' => "Bearer $token"]
        );

        $this->assertNotNull(F00_GeneralSteps::$responseData);
        Log::debug('REQUEST RESULT');
        Log::debug(F00_GeneralSteps::$responseData);
    }

    /**
     * @Then /^the support request status is set to approved$/
     */
    public function theSupportRequestStatusIsSetToApproved()
    {
        $id = F00_GeneralSteps::$requestData['solicitud_id'];
        $solicitud = BenSolicitud::find($id);
        $this->assertEquals(
            DatabaseEnums::BEN_EST_APROBADO,
            $solicitud->estatus
        );
    }

    /**
     * @Given /^the approval date is set$/
     */
    public function theApprovalDateIsSet()
    {
        $id = F00_GeneralSteps::$requestData['solicitud_id'];
        $solicitud = BenSolicitud::find($id);
        $this->assertNotNull($solicitud->fecha_aceptacion);
    }

    /**
     * @Then /^the support request data is not changed$/
     */
    public function theSupportRequestDataIsNotChanged()
    {
        $newSupportRequest = BenSolicitud::find(
            F00_GeneralSteps::$requestData['solicitud_id']
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->id,
            $newSupportRequest->id
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->fecha_solicitud,
            $newSupportRequest->fecha_solicitud
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->fecha_aceptacion,
            $newSupportRequest->fecha_aceptacion
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->fecha_entrega,
            $newSupportRequest->fecha_entrega
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->estatus,
            $newSupportRequest->estatus
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->monto,
            $newSupportRequest->monto
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->evidencia,
            $newSupportRequest->evidencia
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->beneficiario_id,
            $newSupportRequest->beneficiario_id
        );

        $this->assertEquals(
            UpdateSupportRequestStatus::$originalSupportRequest->apoyo_secretaria_id,
            $newSupportRequest->apoyo_secretaria_id
        );
    }

    /**
     * @Given /^I get a missing request status error message$/
     */
    public function iGetAMissingRequestStatusErrorMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('estatus', $responseData['errors']);

        $this->assertContains(
            'El estatus es requerido',
            $responseData['errors']['estatus']
        );
    }

    /**
     * @Given /^I provide a support request that not exists in the system$/
     */
    public function iProvideASupportRequestThatNotExistsInTheSystem()
    {
        F00_GeneralSteps::$requestData['solicitud_id'] = 100000;
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get an invalid support request error message$/
     */
    public function iGetAnInvalidSupportRequestErrorMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('solicitud_id', $responseData['errors']);

        $this->assertContains(
            'El id debe corresponder a una solicitud existente',
            $responseData['errors']['solicitud_id']
        );
    }

    /**
     * @Then /^I get a missing approval date error message$/
     */
    public function iGetAMissingApprovalDateErrorMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('fecha_aceptacion', $responseData['errors']);

        $this->assertContains(
            'La fecha de aceptación es requerida',
            $responseData['errors']['fecha_aceptacion']
        );
    }

    /**
     * @Given /^I provide a valid delivery date$/
     */
    public function iProvideAValidDeliveryDate()
    {
        F00_GeneralSteps::$requestData['fecha_entrega'] =
            Carbon::now()->format('Y-m-d H:i:s');
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide the delivered status$/
     */
    public function iProvideTheDeliveredStatus()
    {
        F00_GeneralSteps::$requestData['estatus']
            = DatabaseEnums::BEN_EST_ENTREGADO;
        $this->assertTrue(true);
    }

    /**
     * @Then /^the support request status is set to delivered$/
     */
    public function theSupportRequestStatusIsSetToDelivered()
    {
        $id = F00_GeneralSteps::$requestData['solicitud_id'];
        $solicitud = BenSolicitud::find($id);
        $this->assertEquals(
            DatabaseEnums::BEN_EST_ENTREGADO,
            $solicitud->estatus
        );
    }

    /**
     * @Given /^the delivery date is set$/
     */
    public function theDeliveryDateIsSet()
    {
        $id = F00_GeneralSteps::$requestData['solicitud_id'];
        $solicitud = BenSolicitud::find($id);
        $this->assertNotNull($solicitud->fecha_entrega);
    }

    /**
     * @Then /^I get a missing delivery date error message$/
     */
    public function iGetAMissingDeliveryDateErrorMessage()
    {
        $responseData = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('fecha_entrega', $responseData['errors']);

        $this->assertContains(
            'La fecha de entrega es requerida',
            $responseData['errors']['fecha_entrega']
        );
    }
}
