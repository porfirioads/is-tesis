<?php

namespace Tests\Feature\F00_InsertarSolicitud;

use Behat\Behat\Context\Context;
use Tests\DatabaseTestCase;

class InsertarSolicitud extends DatabaseTestCase implements Context
{
    private static $authToken;

    public function iAmLoggedInTheSystem()
    {
        InsertarSolicitud::$authToken = null;
        $data = ['username' => 'porfirioads', 'password' => 'porfirioads'];
        $response = $this->post('api/v2/login', $data);
        $response->assertStatus(200);
        $responseData = $response->baseResponse->original;
        InsertarSolicitud::$authToken = $responseData['token'];
        $this->assertNotNull(InsertarSolicitud::$authToken);
    }

    public function iProvideTheCompleteAndCorrectDataForASupportRequest()
    {
        $this->assertTrue(true);
    }

    public function iRegisterTheSupportRequest()
    {
        $this->assertTrue(true);
    }

    public function theSupportRequestIsRegistered()
    {
        $this->assertTrue(true);
    }

    public function iGetTheInformationOfTheCreatedSupportRequest()
    {
        $this->assertTrue(true);
    }
}
