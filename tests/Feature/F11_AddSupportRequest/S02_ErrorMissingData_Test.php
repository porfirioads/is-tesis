<?php

namespace Tests\Feature\F11_AddSupportRequest;

// phpcs:ignore
class S02_ErrorMissingData_Test extends F11_AddSupportRequest
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testIDoNotProvideCompleteDataForASupportRequest()
    {
        $this->iDoNotProvideCompleteDataForASupportRequest();
    }

    public function testWhenIRegisterTheSupportRequest()
    {
        $this->iRegisterTheSupportRequest();
    }

    public function testThenTheSupportRequestIsNotRegistered()
    {
        $this->theSupportRequestIsNotRegistered();
    }

    public function testIGetAnErrorSupportRequestInsertionMessage()
    {
        $this->iGetAnErrorSupportRequestInsertionMessage();
    }
}
