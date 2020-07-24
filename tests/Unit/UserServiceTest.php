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
    public function testExample()
    {
        dump(env('APP_ENV'));
        dump(env('BCRYPT_ROUNDS'));
        dump(env('CACHE_DRIVER'));
        dump(env('DB_CONNECTION'));
        dump(env('DB_DATABASE'));
        dump(env('MAIL_MAILER'));
        dump(env('QUEUE_CONNECTION'));
        dump(env('SESSION_DRIVER'));
        dump(env('TELESCOPE_ENABLED'));
//        $env = env('APP_ENV');
//        $this->assertEquals('prod', $env);
        $userService = UserService::getInstance();
//        $users = $userService->getAll();
//        $this->assertEquals('hola', $users);
        $this->assertTrue(true);
    }
}

