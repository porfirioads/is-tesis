<?php

namespace Tests\Feature\F08_InsertFeedback;

// phpcs:ignore
class F08S03_InsertFeedback_NonExistentReport_Test extends F08_InsertFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIInsertFeedbackForANonExistentReport()
    {
        $this->iInsertFeedbackForANonExistentReport();
    }

    public function testThenIGetAnErrorFeedbackInsertionErrorMessage()
    {
        $this->iGetAnErrorFeedbackInsertionErrorMessage();
    }
}
