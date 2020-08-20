<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S01_SuccessfulSupportRequestApproval_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAValidSupportRequest()
    {
        $this->iProvideAValidSupportRequest();
    }

    public function testAndIProvideAValidApprovalDate()
    {
        $this->iProvideAValidApprovalDate();
    }

    public function testAndIProvideTheApprovedStatus()
    {
        $this->iProvideTheApprovedStatus();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenTheSupportRequestStatusIsSetToApproved()
    {
        $this->theSupportRequestStatusIsSetToApproved();
    }

    public function testAndTheApprovalDateIsSet()
    {
        $this->theApprovalDateIsSet();
    }
}
