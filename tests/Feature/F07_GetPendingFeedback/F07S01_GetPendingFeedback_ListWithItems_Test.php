<?php

namespace Tests\Feature\F07_GetPendingFeedback;

// phpcs:ignore
class F07S01_GetPendingFeedback_ListWithItems_Test extends F07_GetPendingFeedback
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testGivenThereAreItemsInThePendingFeedbackList()
    {
        $this->thereAreItemsInThePendingFeedbackList();
    }

    public function testWhenThePendingFeedbackListIsReturned()
    {
        $this->thePendingFeedbackListIsReturned();
    }

    public function testThenIGetTheOnesThatHaveNotBeenNotifiedToTheUsers()
    {
        $this->iGetTheOnesThatHaveNotBeenNotifiedToTheUsers();
    }
}
