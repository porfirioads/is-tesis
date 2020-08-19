<?php

namespace Tests\Feature\F06_DeleteReport;

// phpcs:ignore
class F06S02_DeleteReport_NonExistentDeletion_Test extends F06_DeleteReport
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIDeleteAReportThatNotExists()
    {
        $this->iDeleteAReportThatNotExists();
    }

    public function testThenIGetAnErrorReportDeletionMessage()
    {
        $this->iGetAnErrorReportDeletionMessage();
    }
}
