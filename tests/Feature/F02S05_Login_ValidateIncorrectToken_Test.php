<?php

namespace Tests\Feature;

// phpcs:ignore
class F02S05_Login_ValidateIncorrectToken_Test extends F02_Login
{
    public function testGivenIHaveAnInvalidToken()
    {
        $this->iHaveAnInvalidToken();
    }

    public function testWhenIVerifyTheToken()
    {
        $this->iVerifyTheToken();
    }

    public function testThenIGetAnErrorTokenValidationMessage()
    {
        $this->iGetAnErrorTokenValidationMessage();
    }
}
