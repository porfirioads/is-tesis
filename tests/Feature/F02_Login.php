<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Hash;
use Tests\DatabaseTestCase;

class F02_Login extends DatabaseTestCase implements Context
{
    private static $loginResponse;
    private static $tokenValidationResponse;
    private static $validationToken;

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
        F02_Login::$validationToken = null;
        $data = ['username' => 'marmor', 'password' => 'marmor'];
        F02_Login::$loginResponse = $this->post('api/login', $data);
        F02_Login::$loginResponse->assertStatus(200);
        F02_Login::$validationToken = F02_Login::$loginResponse->getData()->token;
    }

    /**
     * @Then /^I get a token and the user data\.$/
     */
    public function iGetATokenAndTheUserData()
    {
        $data = F02_Login::$loginResponse->getData();
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
        F02_Login::$loginResponse = $this->post('api/login', $data);
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get an authentication error\.$/
     */
    public function iGetAnAuthenticationError()
    {
        F02_Login::$loginResponse->assertStatus(401);
    }

    /**
     * @When /^I login without specify a password$/
     */
    public function iLoginWithoutSpecifyAPassword()
    {
        $data = ['username' => 'marmor'];
        F02_Login::$loginResponse = $this->post('api/login', $data);
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get a validation error$/
     */
    public function iGetAValidationError()
    {
        F02_Login::$loginResponse->assertStatus(400);
    }

    /**
     * @When /^I verify the token$/
     */
    public function iVerifyTheToken()
    {
        $token = F02_Login::$validationToken;
        $headers = ['Authorization' => "Bearer $token"];
        F02_Login::$tokenValidationResponse = $this->post('api/validate_token',
            [], $headers);
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get a success token validation message\.$/
     */
    public function iGetASuccessTokenValidationMessage()
    {
        F02_Login::$tokenValidationResponse->assertStatus(200);
        $data = F02_Login::$tokenValidationResponse->getData();
        $this->assertObjectHasAttribute('result', $data);
        $this->assertEquals('PRUEBA DE TOKEN EXISTOSA', $data->result);
    }

    /**
     * @Given /^I have an invalid token$/
     */
    public function iHaveAnInvalidToken()
    {
        F02_Login::$validationToken = 'SomeInvalidToken';
        $this->assertTrue(true);
    }

    /**
     * @Then /^I get an error token validation message\.$/
     */
    public function iGetAnErrorTokenValidationMessage()
    {
        F02_Login::$tokenValidationResponse->assertStatus(401);
        $data = F02_Login::$tokenValidationResponse->getData();
        $this->assertObjectHasAttribute('errors', $data);
        $this->assertObjectHasAttribute('auth', $data->errors);
        $this->assertEquals('El token de autenticación es inválido', $data->errors->auth);
    }
}
