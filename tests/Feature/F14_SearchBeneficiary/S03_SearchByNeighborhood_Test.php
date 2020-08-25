<?php

namespace Tests\Feature\F14_SearchBeneficiary;

// phpcs:ignore
class S03_SearchByNeighborhood_Test extends SearchBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAnAssignedNeighborhood()
    {
        $this->iProvideAnAssignedNeighborhood();
    }

    public function testWhenISearchTheBeneficiary()
    {
        $this->iSearchTheBeneficiary();
    }

    public function testThenIGetTheDataOfTheFoundBeneficiary()
    {
        $this->iGetTheDataOfTheFoundBeneficiary();
    }
}
