<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S05_SuccessfulSupportRequestDelivery_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAValidSupportRequest()
    {
        $this->iProvideAValidSupportRequest();
    }

    public function testAndIProvideTheDeliveredStatus()
    {
        $this->iProvideTheDeliveredStatus();
    }

    public function testAndIProvideAValidDeliveryDate()
    {
        $this->iProvideAValidDeliveryDate();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenTheSupportRequestStatusIsSetToDelivered()
    {
        $this->theSupportRequestStatusIsSetToDelivered();
    }

    public function testAndTheDeliveryDateIsSet()
    {
        $this->theDeliveryDateIsSet();
    }
}
