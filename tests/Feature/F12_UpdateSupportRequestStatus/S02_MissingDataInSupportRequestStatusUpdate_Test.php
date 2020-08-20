<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S02_MissingDataInSupportRequestStatusUpdate_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAValidSupportRequest()
    {
        $this->iProvideAValidSupportRequest();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenTheSupportRequestDataIsNotChanged()
    {
        $this->theSupportRequestDataIsNotChanged();
    }

    public function testAndIGetAMissingRequestStatusErrorMessage()
    {
        $this->iGetAMissingRequestStatusErrorMessage();
    }
}
