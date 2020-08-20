<?php

namespace Tests\Feature\F12_UpdateSupportRequestStatus;

// phpcs:ignore
class S06_DeliveryDateMissingSettingDeliveredStatus_Test extends UpdateSupportRequestStatus
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideTheDeliveredStatus()
    {
        $this->iProvideTheDeliveredStatus();
    }

    public function testWhenIChangeTheStatusOfTheSupportRequest()
    {
        $this->iChangeTheStatusOfTheSupportRequest();
    }

    public function testThenIGetAMissingDeliveryDateErrorMessage()
    {
        $this->iGetAMissingDeliveryDateErrorMessage();
    }
}
