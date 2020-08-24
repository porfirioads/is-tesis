<?php

namespace Tests\Feature\F13_RegisterBeneficiary;

// phpcs:ignore
class S02_MissingRequiredData_Test extends RegisterBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAValidCurp()
    {
        $this->iProvideAValidCurp();
    }

    public function testWhenIRegisterTheBeneficiary()
    {
        $this->iRegisterTheBeneficiary();
    }

    public function testThenTheBeneficiaryIsNotRegistered()
    {
        $this->theBeneficiaryIsNotRegistered();
    }

    public function testAndIGetAMissingNameErrorMessage()
    {
        $this->iGetAMissingNameErrorMessage();
    }

    public function testAndIGetAMissingLastnameErrorMessage()
    {
        $this->iGetAMissingLastnameErrorMessage();
    }

    public function testAndIGetAMissingGenreErrorMessage()
    {
        $this->iGetAMissingGenreErrorMessage();
    }

    public function testAndIGetAMissingPhoneErrorMessage()
    {
        $this->iGetAMissingPhoneErrorMessage();
    }

    public function testAndIGetAMissingStreetNameErrorMessage()
    {
        $this->iGetAMissingStreetNameErrorMessage();
    }

    public function testAndIGetAMissingHouseNumberErrorMessage()
    {
        $this->iGetAMissingHouseNumberErrorMessage();
    }

    public function testAndIGetAMissingNeighborhoodErrorMessage()
    {
        $this->iGetAMissingNeighborhoodErrorMessage();
    }
}
