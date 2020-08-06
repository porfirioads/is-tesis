<?php

namespace Tests\Unit;

use App\Models\Usuario;
use App\Services\UserService;
use Tests\DatabaseEachTestCase;

// phpcs:ignore
class U02_UserServiceTest extends DatabaseEachTestCase
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
        Usuario::where('id', '>', 0)->delete();
        $users = $this->userService->getAll();
        $this->assertEquals(0, count($users));
    }

    public function testGetByCredentials()
    {
//        $this->seed();
        $user = $this->userService->getByCredentials('porfirioads', 'porfirioads');
        $this->assertNotNull($user);
    }

    public function testGetByIncorrectCredentials()
    {
        $user = $this->userService->getByCredentials('porfirioads', 'holamundo');
        $this->assertNull($user);
    }
}
