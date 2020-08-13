<?php

namespace Tests\Feature;

// phpcs:ignore
class F10S01_GetSupportList_ListWithITems_Test extends F10_GetSupportList
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndThereAreItemsInTheSupportList()
    {
        $this->thereAreItemsInTheSupportList();
    }

    public function testWhenTheSupportListIsReturned()
    {
        $this->theSupportListIsReturned();
    }

    public function testEachElementHasTheBeneficiaryInformation()
    {
        $this->eachElementHasTheBeneficiaryInformation();
    }

    public function testEachElementHasTheSupportType()
    {
        $this->eachElementHasTheSupportType();
    }

    public function testEachElementHasTheSupportAmount()
    {
        $this->eachElementHasTheSupportAmount();
    }

    public function testEachElementHasTheDateOfSupport()
    {
        $this->eachElementHasTheDateOfSupport();
    }
}
