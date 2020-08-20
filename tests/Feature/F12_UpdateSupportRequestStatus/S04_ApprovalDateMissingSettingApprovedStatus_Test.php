<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S04_ApprovalDateMissingSettingApprovedStatus_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideTheApprovedStatus()
    {
        $this->iProvideTheApprovedStatus();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenIGetAMissingApprovalDateErrorMessage()
    {
        $this->iGetAMissingApprovalDateErrorMessage();
    }
}
