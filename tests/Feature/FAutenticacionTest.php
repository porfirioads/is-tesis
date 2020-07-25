<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FAutenticacionTest extends DatabaseTestCase
{
    public function testGetUsersApi()
    {
        $response = $this->get('api/usuarios');
        $response->assertStatus(200);
        $users = $response->baseResponse->original;
        $this->assertGreaterThanOrEqual(1, count($users));
    }
}
