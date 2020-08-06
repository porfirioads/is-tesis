<?php

namespace Tests\Feature;

// phpcs:ignore
class F05S02_UpdateReportType_NonExistentType_Test extends F05_UpdateReportType
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIChangeTheReportTypeWithANonExistentOne()
    {
        $this->iChangeTheReportTypeWithANonExistentOne();
    }

    public function testThenIGetAnInvalidReportTypeErrorMessage()
    {
        $this->iGetAnInvalidReportTypeErrorMessage();
    }
}
