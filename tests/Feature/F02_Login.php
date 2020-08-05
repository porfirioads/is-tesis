<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Hash;
use Tests\DatabaseTestCase;

class F02_Login extends DatabaseTestCase implements Context
{
    private static $response;

    /**
     * @Given /^there are valid users in the system$/
     */
    public function thereAreValidUsersInTheSystem()
    {
        $usuario = new Usuario();
        $usuario->nombre = 'Marco';
        $usuario->primer_apellido = 'Morales';
        $usuario->email = 'marmor@gmail.com';
        $usuario->username = 'marmor';
        $usuario->password = Hash::make('marmor');
        $usuario->save();
        $count = Usuario::count();
        $this->assertGreaterThanOrEqual(1, $count);
    }

    /**
     * @When /^I login using valid credentials$/
     */
    public function iLoginUsingValidCredentials()
    {
        $data = ['username' => 'marmor', 'password' => 'marmor'];
        F02_Login::$response = $this->post('api/login', $data);
        F02_Login::$response->assertStatus(200);
    }

    /**
     * @Then /^I get a token and the user data\.$/
     */
    public function iGetATokenAndTheUserData()
    {
        $data = F02_Login::$response->getData();
        $expectedAttributes = ['token', 'usuario'];

        foreach ($expectedAttributes as $attribute) {
            $this->assertObjectHasAttribute($attribute, $data);
        }

        $expectedAttributes = [
            'id',
            'username',
            'nombre',
            'primer_apellido',
            'segundo_apellido'
        ];

        foreach ($expectedAttributes as $attribute) {
            $this->assertObjectHasAttribute($attribute, $data->usuario);
        }
    }

    /**
     * @When /^I login using invalid credentials$/
     */
    public function iLoginUsingInvalidCredentials()
    {
        $data = ['username' => 'marmor', 'password' => 'marmors'];
        F02_Login::$response = $this->post('api/login', $data);
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get an authentication error\.$/
     */
    public function iGetAnAuthenticationError()
    {
        F02_Login::$response->assertStatus(401);
    }

    /**
     * @When /^I login without specify a password$/
     */
    public function iLoginWithoutSpecifyAPassword()
    {
        $data = ['username' => 'marmor'];
        F02_Login::$response = $this->post('api/login', $data);
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get a validation error$/
     */
    public function iGetAValidationError()
    {
        F02_Login::$response->assertStatus(400);
    }
}
