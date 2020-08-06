<?php

namespace Tests\Mocks;

use App\Services\UserService;
use Mockery;

class UserServiceMockBuilder
{
    private $mock;

    private function __construct()
    {
        $this->mock = Mockery::mock(UserService::class);
    }

    public static function create()
    {
        return new UserServiceMockBuilder();
    }

    protected function mockFunction($functionName, $returnValue)
    {
        $this->mock->allows([$functionName => $returnValue]);
        return $this;
    }

    public function mockGetUsersWithData()
    {
        $this->mockFunction('getAll', [
            [
                "id" => 1,
                "username" => "porfirioads",
                "nombre" => "Porfirio Ángel",
                "primer_apellido" => "Díaz",
                "segundo_apellido" => "Sánchez",
                "email" => "porfirioads@gmail.com",
                "roles" => [
                    [
                        "rol" => "COORDINADOR",
                        "secretaria" => "SECRETARÍA DE PLANEACIÓN"
                    ]
                ]
            ],
            [
                "id" => 2,
                "username" => "planeacion",
                "nombre" => "Víctor",
                "primer_apellido" => "Miranda",
                "segundo_apellido" => null,
                "email" => "splaneacionzac@gmail.com",
                "roles" => [
                    [
                        "rol" => "SECRETARIO",
                        "secretaria" => "SECRETARÍA DE PLANEACIÓN"
                    ]
                ]
            ],
            [
                "id" => 3,
                "username" => "contraloria",
                "nombre" => "Marco",
                "primer_apellido" => "Del Hoyo",
                "segundo_apellido" => "Lozano",
                "email" => "contraloriazac@gmail.com",
                "roles" => [
                    [
                        "rol" => "JEFE_DEPARTAMENTO",
                        "secretaria" => "CONTRALORÍA MUNICIPAL"
                    ]
                ]
            ]
        ]);

        return $this;
    }

    public function mockGetUserByCredentials()
    {
        $this->mockFunction('getByCredentials', [
            "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9." .
                "eyJpYXQiOjE1OTY1NDk5NDgsInVpZCI6MTU5NjU0OTk0" .
                "OCwiaXNzIjoibG9jYWxob3N0IiwidXNlcm5hbWUiOiJw" .
                "b3JmaXJpb2FkcyJ9.cNrBzf2QBxcsVf8iDrWl24saTXYr3hR20U6Ju7kvoSg",
            "usuario" => [
                "id" => 1,
                "username" => "porfirioads",
                "nombre" => "Porfirio Ángel",
                "primer_apellido" => "Díaz",
                "segundo_apellido" => "Sánchez",
                "email" => "porfirioads@gmail.com",
                "roles" => [
                    [
                        "rol" => "COORDINADOR",
                        "secretaria" => "SECRETARÍA DE PLANEACIÓN"
                    ]
                ]
            ]
        ]);

        return $this;
    }

    public function mockGetUserByCredentialsInvalid()
    {
        $this->mockFunction('getByCredentials', null);
        return $this;
    }

    public function getResult()
    {
        return $this->mock;
    }
}
