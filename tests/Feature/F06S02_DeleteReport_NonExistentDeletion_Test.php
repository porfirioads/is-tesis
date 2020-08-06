<?php

namespace Tests\Feature;

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
