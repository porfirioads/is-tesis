<?php

namespace Tests\Feature;

// phpcs:ignore
class F09S02_DeleteFeedback_MissingData_Test extends F09_DeleteFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testWhenIDeleteAFeedbackWithMissingData()
    {
        $this->iDeleteAFeedbackWithMissingData();
    }

    public function testThenIGetAnErrorFeedbackDeletionMessage()
    {
        $this->iGetAnErrorFeedbackDeletionMessage();
    }
}
