<?php

namespace Tests\Feature\F08_InsertFeedback;

// phpcs:ignore
class F08S01_InsertFeedback_Successful_Test extends F08_InsertFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndThereAreItemsInTheReportsList()
    {
        $this->thereAreItemsInTheReportsList();
    }

    public function testWhenIInsertFeedbackForAReport()
    {
        $this->iInsertFeedbackForAReport();
    }

    public function testThenIGetInsertedFeedbackDetails()
    {
        $this->iGetTheInsertedFeedbackDetails();
    }
}
