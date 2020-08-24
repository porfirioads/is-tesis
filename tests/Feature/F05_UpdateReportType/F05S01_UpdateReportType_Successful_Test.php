<?php

namespace Tests\Feature\F05_UpdateReportType;

// phpcs:ignore
class F05S01_UpdateReportType_Successful_Test extends F05_UpdateReportType
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIChangeTheReportTypeWithOtherValid()
    {
        $this->iChangeTheReportTypeWithOtherValid();
    }

    public function testThenIGetTheUpdatedReportDetails()
    {
        $this->iGetTheUpdatedReportDetails();
    }
}
