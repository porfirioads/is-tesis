<?php

namespace Tests\Unit;

use App\ObjectFactory;
use Tests\TestCase;

class U05_JwtMiddlewareTest extends TestCase
{
    public function testSuccessAuthentication()
    {
        $jwtService = ObjectFactory::getJwtService();
        $token = $jwtService->generate('porfirioangel');
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->post('api/validate_token', [], $headers);
        $response->assertStatus(200);
    }

    public function testToken()
    {
        $token = 'some_invalid_token';
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->post('api/validate_token', [], $headers);
        $response->assertStatus(401);
    }
}
