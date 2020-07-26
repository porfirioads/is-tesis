<?php

namespace Tests\Unit;

use App\Services\JwtService;
use Tests\TestCase;

class U01_JwtServiceTest extends TestCase
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
        $jwtService = JwtService::getInstance();
        $validationResult = $jwtService->validate('holamundo');
        $this->assertIsBool($validationResult);
        $this->assertFalse($validationResult);
        $errors = $jwtService->getErrors();
        $this->assertIsArray($errors);
        $this->assertGreaterThan(0, count($errors));
    }

    public function testJwtNoToken()
    {
        $validationResult = JwtService::getInstance()->validate(null);
        $this->assertFalse($validationResult);
    }
}
