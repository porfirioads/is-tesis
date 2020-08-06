<?php

namespace Tests\Feature;

// phpcs:ignore
class F08S02_InsertFeedback_MissingData_Test extends F08_InsertFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIInsertFeedbackWithMissingData()
    {
        $this->iInsertFeedbackWithMissingData();
    }

    public function testThenIGetAnErrorFeedbackInsertionErrorMessage()
    {
        $this->iGetAnErrorFeedbackInsertionErrorMessage();
    }
}
