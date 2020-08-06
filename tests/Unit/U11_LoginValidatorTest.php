<?php

namespace Tests\Unit;

use App\Http\Validators\LoginValidator;
use Illuminate\Http\Request;
use Tests\TestCase;

// phpcs:ignore
class U11_LoginValidatorTest extends TestCase
{
    public function testValidationSuccess()
    {
        $data = [
            'username' => 'porfirioads',
            'password' => 'porfirioads'
        ];
        $request = new Request($data);
        $validator = new LoginValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertTrue($success);
        $this->assertCount(0, $errors);
    }

    public function testValidatorAskForRequiredData()
    {
        $data = [];
        $request = new Request($data);
        $validator = new LoginValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertCount(2, $errors);
        $this->assertArrayHasKey('username', $errors);
        $this->assertContains('El nombre de usuario es requerido.', $errors['username']);
        $this->assertArrayHasKey('password', $errors);
        $this->assertContains('La contraseña es requerida.', $errors['password']);
    }
}
