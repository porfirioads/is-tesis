<?php

namespace Tests\Feature\F00_InsertarSolicitud;

class SolicitudExitosaTest extends InsertarSolicitud
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideTheCompleteAndCorrectDataForASupportRequest()
    {
        $this->iProvideTheCompleteAndCorrectDataForASupportRequest();
    }

    public function testWhenIRegisterTheSupportRequest()
    {
        $this->iRegisterTheSupportRequest();
    }

    public function testThenTheSupportRequestIsRegistered()
    {
        $this->theSupportRequestIsRegistered();
    }

    public function testAndIGetTheInformationOfTheCreatedSupportRequest()
    {
        $this->iGetTheInformationOfTheCreatedSupportRequest();
    }
}
