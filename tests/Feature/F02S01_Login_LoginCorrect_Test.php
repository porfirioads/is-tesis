<?php

namespace Tests\Feature;

class F02S01_Login_LoginCorrect_Test extends F02_Login
{
    public function testGivenThereAreValidUsersInTheSystem()
    {
        $this->thereAreValidUsersInTheSystem();
    }

    public function testWhenILoginUsingValidCredentials()
    {
        $this->iLoginUsingValidCredentials();
    }

    public function testThenIGetATokenAndTheUserData()
    {
        $this->iGetATokenAndTheUserData();
    }
}
