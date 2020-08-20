<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S03_NonExistentSupportRequest_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideASupportRequestThatNotExistsInTheSystem()
    {
        $this->iProvideASupportRequestThatNotExistsInTheSystem();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenIGetAnInvalidSupportRequestErrorMessage()
    {
        $this->iGetAnInvalidSupportRequestErrorMessage();
    }
}
