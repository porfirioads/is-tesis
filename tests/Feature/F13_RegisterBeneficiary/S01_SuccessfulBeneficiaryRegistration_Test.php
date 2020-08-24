<?php

namespace Tests\Feature\F13_RegisterBeneficiary;

// phpcs:ignore
class S01_SuccessfulBeneficiaryRegistration_Test extends RegisterBeneficiary
{
    public function testGivenIAmLoggedInTheSystem()
    {
        $this->iAmLoggedInTheSystem();
    }

    public function testAndIProvideAValidCurp()
    {
        $this->iProvideAValidCurp();
    }

    public function testAndIProvideAValidName()
    {
        $this->iProvideAValidName();
    }

    public function testAndIProvideAValidLastname()
    {
        $this->iProvideAValidLastname();
    }

    public function testAndIProvideAValidSecondLastname()
    {
        $this->iProvideAValidSecondLastname();
    }

    public function testAndIProvideAValidGenre()
    {
        $this->iProvideAValidGenre();
    }

    public function testAndIProvideAValidPhoneNumber()
    {
        $this->iProvideAValidPhoneNumber();
    }

    public function testAndIProvideAValidStreetName()
    {
        $this->iProvideAValidStreetName();
    }

    public function testAndIProvideAValidHouseNumber()
    {
        $this->iProvideAValidHouseNumber();
    }

    public function testAndIProvideAValidApartmentNumber()
    {
        $this->iProvideAValidApartmentNumber();
    }

    public function testAndIProvideAValidNeighborhood()
    {
        $this->iProvideAValidNeighborhood();
    }

    public function testWhenIRegisterTheBeneficiary()
    {
        $this->iRegisterTheBeneficiary();
    }

    public function testThenTheBeneficiaryIsRegistered()
    {
        $this->theBeneficiaryIsRegistered();
    }

    public function testAndIGetTheDataOfTheRegisteredBeneficiary()
    {
        $this->iGetTheDataOfTheRegisteredBeneficiary();
    }
}
