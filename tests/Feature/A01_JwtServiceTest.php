<?php

namespace Tests\Feature;

use App\Services\JwtService;
use Tests\TestCase;

class A01_JwtServiceTest extends TestCase
{
    public function testJwtPayloadValid()
    {
        $username = 'marco';
        $jwtService = JwtService::getInstance();
        $token = $jwtService->generate($username);
        $payload = $jwtService->decrypt($token);
        $this->assertIsArray($payload);
        $this->assertArrayHasKey('username', $payload);
        $this->assertEquals($payload['username'], $username);
    }

    public function testJwtPayloadInvalid()
    {
        $payload = JwtService::getInstance()->decrypt('holamundo');
        $this->assertNull($payload);
    }

    public function testJwtValid()
    {
        $username = 'marco';
        $jwtService = JwtService::getInstance();
        $token = $jwtService->generate($username);
        $validationResult = $jwtService->validate($token);
        $this->assertIsBool($validationResult);
        $this->assertTrue($validationResult);
    }

    public function testJwtInvalid()
    {
        $validationResult = JwtService::getInstance()->validate('holamundo');
        $this->assertFalse($validationResult);
    }

    public function testJwtNoToken()
    {
        $validationResult = JwtService::getInstance()->validate(null);
        $this->assertFalse($validationResult);
    }
}
