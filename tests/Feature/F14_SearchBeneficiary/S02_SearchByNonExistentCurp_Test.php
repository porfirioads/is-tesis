<?php

namespace Tests\Feature\F14_SearchBeneficiary;

// phpcs:ignore
class S02_SearchByNonExistentCurp_Test extends SearchBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideANonExistentCurp()
    {
        $this->iProvideANonExistentCurp();
    }

    public function testWhenISearchTheBeneficiary()
    {
        $this->iSearchTheBeneficiary();
    }

    public function testIGetANonExistentCurpErrorMessage()
    {
        $this->iGetaNonExistentCurpErrorMessage();
    }
}
