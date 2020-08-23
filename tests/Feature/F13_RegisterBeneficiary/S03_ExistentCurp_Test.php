<?php

namespace Tests\Feature\F13_RegisterBeneficiary;

// phpcs:ignore
class S03_ExistentCurp_Test extends RegisterBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAnExistentCurp()
    {
        $this->iProvideAnExistentCurp();
    }

    public function testWhenIRegisterTheBeneficiary()
    {
        $this->iRegisterTheBeneficiary();
    }

    public function testThenTheBeneficiaryIsNotRegistered()
    {
        $this->theBeneficiaryIsNotRegistered();
    }

    public function testAndIGetAnExistentCurpErrorMessage()
    {
        $this->iGetAnExistentCurpErrorMessage();
    }
}
