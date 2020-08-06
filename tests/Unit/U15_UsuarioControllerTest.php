<?php

namespace Tests\Unit;

use App\Http\Controllers\UsuarioController;
use App\ObjectFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;
use Tests\Mocks\RequestValidatorMockBuilder;
use Tests\Mocks\UserServiceMockBuilder;

// phpcs:ignore
class U15_UsuarioControllerTest extends DatabaseEachTestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        ObjectFactory::$useMocks = true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        ObjectFactory::$useMocks = false;
    }

    public function testGetUsuarios()
    {
        ObjectFactory::$userServiceMock = UserServiceMockBuilder::create()
            ->mockGetUsersWithData()
            ->getResult();

        $controller = new UsuarioController();
        $request = new Request();
        $response = $controller->getUsers($request);
        $this->assertEquals(200, $response->status());

        $expectedAttributes = [
            'id',
            'username',
            'nombre',
            'primer_apellido',
            'segundo_apellido',
            'email',
            'roles'
        ];

        $data = $response->getData();

        foreach ($data as $user) {
            foreach ($expectedAttributes as $attribute) {
                $this->assertObjectHasAttribute($attribute, $user);
            }
        }
    }

    public function testLogin()
    {
        ObjectFactory::$userServiceMock = UserServiceMockBuilder::create()
            ->mockGetUserByCredentials()
            ->getResult();

        ObjectFactory::$loginValidatorMock = RequestValidatorMockBuilder::errorValidation();

        $controller = new UsuarioController();
        $request = new Request();
        $response = $controller->login($request);
        $this->assertEquals(400, $response->status());
    }

    public function testLoginInvalidValidation()
    {
        ObjectFactory::$userServiceMock = UserServiceMockBuilder::create()
            ->mockGetUserByCredentials()
            ->getResult();

        ObjectFactory::$loginValidatorMock = RequestValidatorMockBuilder::successValidation();

        $controller = new UsuarioController();
        $request = new Request();
        $response = $controller->login($request);
        $expectedAttributes = ['token', 'usuario'];
        $this->assertEquals(200, $response->status());
        $data = $response->getData();

        foreach ($expectedAttributes as $attribute) {
            $this->assertObjectHasAttribute($attribute, $data);
        }
    }

    public function testLoginInvalidUser()
    {
        ObjectFactory::$userServiceMock = UserServiceMockBuilder::create()
            ->mockGetUserByCredentialsInvalid()
            ->getResult();

        ObjectFactory::$loginValidatorMock = RequestValidatorMockBuilder::successValidation();
        $controller = new UsuarioController();
        $request = new Request();
        $response = $controller->login($request);
        $data = $response->getData();
        $this->assertEquals(401, $response->status());
        $this->assertObjectHasAttribute('errors', $data);
        $this->assertObjectHasAttribute('auth', $data->errors);
        $this->assertEquals('Credenciales inválidas', $data->errors->auth);
    }

    public function testValidateToken()
    {
        $controller = new UsuarioController();
        $request = new Request();
        $response = $controller->validateToken($request);
        $this->assertEquals(200, $response->getStatusCode());
        $data = $response->getData();
        $this->assertObjectHasAttribute('result', $data);
        $this->assertEquals('PRUEBA DE TOKEN EXISTOSA', $data->result);
    }
}
