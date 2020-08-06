<?php

namespace Tests\Feature;

// phpcs:ignore
class F02S04_Login_ValidateCorrectToken_Test extends F02_Login
{
    public function testGivenThereAreValidUsersInTheSystem()
    {
        $this->thereAreValidUsersInTheSystem();
    }

    public function testWhenILoginUsingValidCredentials()
    {
        $this->iLoginUsingValidCredentials();
    }

    public function testWhenIVerifyTheToken()
    {
        $this->iVerifyTheToken();
    }

    public function testIGetASuccessTokenValidationMessage()
    {
        $this->iGetASuccessTokenValidationMessage();
    }
}
