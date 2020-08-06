<?php

namespace Tests\Feature;

// phpcs:ignore
class F09S01_DeleteFeedback_SuccessDeletion_Test extends F09_DeleteFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndThereAreItemsInTheFeedbackList()
    {
        $this->thereAreItemsInTheFeedbackList();
    }

    public function testWhenIDeleteAFeedback()
    {
        $this->iDeleteAFeedback();
    }

    public function testThenIGetASuccessFeedbackDeletionMessage()
    {
        $this->iGetASuccessFeedbackDeletionMessage();
    }
}
