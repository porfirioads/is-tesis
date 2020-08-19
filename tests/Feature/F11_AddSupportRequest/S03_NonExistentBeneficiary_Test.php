<?php

namespace Tests\Feature\F11_AddSupportRequest;

// phpcs:ignore
class S03_NonExistentBeneficiary_Test extends F11_AddSupportRequest
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideABeneficiaryThatNotExistsInTheSystem()
    {
        $this->iProvideABeneficiaryThatNotExistsInTheSystem();
    }

    public function testWhenIRegisterTheSupportRequest()
    {
        $this->iRegisterTheSupportRequest();
    }

    public function testThenTheSupportRequestIsNotRegistered()
    {
        $this->theSupportRequestIsNotRegistered();
    }

    public function testAndIGetAnInvalidBeneficiaryErrorMessage()
    {
        $this->iGetAnInvalidBeneficiaryErrorMessage();
    }
}
