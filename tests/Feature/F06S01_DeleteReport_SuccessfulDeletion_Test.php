<?php

namespace Tests\Feature;

class F06S01_DeleteReport_SuccessfulDeletion_Test extends F06_DeleteReport
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIDeleteAReport()
    {
        $this->iDeleteAReport();
    }

    public function testThenIGetASuccessReportDeletionMessage()
    {
        $this->iGetASuccessReportDeletionMessage();
    }
}
