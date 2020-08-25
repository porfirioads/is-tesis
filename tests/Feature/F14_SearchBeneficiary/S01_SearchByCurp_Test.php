<?php

namespace Tests\Feature\F14_SearchBeneficiary;

// phpcs:ignore
class S01_SearchByCurp_Test extends SearchBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAnExistentCurp()
    {
        $this->iProvideAnExistentCurp();
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
