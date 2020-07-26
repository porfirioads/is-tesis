<?php

namespace Tests\Feature;

use Tests\DatabaseTestCase;

class F02_AutenticacionTest extends DatabaseTestCase
{
    public function testGetUsersApi()
    {
        $response = $this->get('api/usuarios');
        $response->assertStatus(200);
        $users = $response->baseResponse->original;
        $this->assertGreaterThanOrEqual(1, count($users));
    }
}
