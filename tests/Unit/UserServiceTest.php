<?php

namespace Tests\Unit;

use App\Models\Usuario;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \DB;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;
use Tests\Traits\DatabaseMigrateFresh;

class UserServiceTest extends TestCase
{
//    use RefreshDatabase;
//    use DatabaseMigrations;
    use CreatesApplication;


    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetUsers()
    {
        $userService = UserService::getInstance();
//        $users = $userService->getAll();
//        $this->assertEquals('hola', $users);
        $this->assertEquals('testing', env('APP_ENV'));
//        $this->assertEquals('mysql', env('DB_CONNECTION'));
//        $this->assertEquals('sigaz_test', env('DB_DATABASE'));
    }
}

