<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Services\UserService;

class UUserServiceTest extends DatabaseTestCase
{
    private $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = UserService::getInstance();
    }

    public function testGetAllUsers()
    {
        $users = $this->userService->getAll();
        $this->assertGreaterThanOrEqual(1, count($users));
    }

    public function testGetZeroUsers()
    {
        Usuario::where('id', '>=', 1)->delete();
        $users = $this->userService->getAll();
        $this->assertEquals(0, count($users));
    }

    public function testGetByCredentials()
    {
        $user = $this->userService->getByCredentials('porfirioads', 'porfirioads');
        $this->assertNotNull($user);
    }

    public function testGetByIncorrectCredentials()
    {
        $user = $this->userService->getByCredentials('porfirioads', 'holamundo');
        $this->assertNull($user);
    }
}
