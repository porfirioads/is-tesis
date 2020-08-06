<?php

namespace Tests\Feature;

// phpcs:ignore
class F02S02_Login_LoginIncorrect_Test extends F02_Login
{
    public function testGivenThereAreValidUsersInTheSystem()
    {
        $this->thereAreValidUsersInTheSystem();
    }

    public function testWhenILoginUsingInvalidCredentials()
    {
        $this->iLoginUsingInvalidCredentials();
    }

    public function testThenIGetAnAuthenticationError()
    {
        $this->iGetAnAuthenticationError();
    }
}
