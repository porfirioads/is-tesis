<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\DatabaseMigrateFresh;

class AutenticacionTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

//    use DatabaseMigrateFresh;


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUsers()
    {
        $response = $this->get('api/usuarios');
        dump($response->baseResponse->original);
        $response->assertStatus(200);
    }
}
