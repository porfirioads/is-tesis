<?php

namespace Tests\Feature\F11_AddSupportRequest;

// phpcs:ignore
class S01_SuccessfulSupportRequestInsertion_Test extends F11_AddSupportRequest
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
