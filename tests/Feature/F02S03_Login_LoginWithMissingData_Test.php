<?php

namespace Tests\Feature;

// phpcs:ignore
class F02S03_Login_LoginWithMissingData_Test extends F02_Login
{
    public function testGivenThereAreValidUsersInTheSystem()
    {
        $this->thereAreValidUsersInTheSystem();
    }

    public function testWhenILoginWithoutSpecifyAPassword()
    {
        $this->iLoginWithoutSpecifyAPassword();
    }

    public function thenIGetAValidationError()
    {
        $this->iGetAValidationError();
    }
}
