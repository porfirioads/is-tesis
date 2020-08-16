<?php

namespace Tests\Feature;

// phpcs:ignore
class F10S02_GetSupportList_EmptyList_Test extends F10_GetSupportList
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndTheSupportListIsEmpty()
    {
        $this->theSupportListIsEmpty();
    }

    public function testWhenTheSupportListIsReturned()
    {
        $this->theSupportListIsReturned();
    }

    public function testICannotSeeAnySupport()
    {
        $this->iCannotSeeAnySupport();
    }
}
