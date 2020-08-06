<?php

namespace Tests\Unit;

use App\ObjectFactory;
use Tests\TestCase;

// phpcs:ignore
class U01_JwtServiceTest extends TestCase
{
    private $jwtService;

    public function setUp(): void
    {
        parent::setUp();
        ObjectFactory::$useMocks = false;
        $this->jwtService = ObjectFactory::getJwtService();
        ObjectFactory::$useMocks = true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        ObjectFactory::$useMocks = false;
    }

    public function testJwtPayloadValid()
    {
        $username = 'marco';
        $token = $this->jwtService->generate($username);
        $payload = $this->jwtService->decrypt($token);
        $this->assertIsArray($payload);
        $this->assertArrayHasKey('username', $payload);
        $this->assertEquals($payload['username'], $username);
    }

    public function testJwtPayloadInvalid()
    {
        $payload = $this->jwtService->decrypt('holamundo');
        $this->assertNull($payload);
    }

    public function testJwtValid()
    {
        $username = 'marco';
        $token = $this->jwtService->generate($username);
        $validationResult = $this->jwtService->validate($token);
        $this->assertIsBool($validationResult);
        $this->assertTrue($validationResult);
    }

    public function testJwtInvalid()
    {
        $validationResult = $this->jwtService->validate('holamundo');
        $this->assertIsBool($validationResult);
        $this->assertFalse($validationResult);
        $errors = $this->jwtService->getErrors();
        $this->assertIsArray($errors);
        $this->assertGreaterThan(0, count($errors));
    }

    public function testJwtNoToken()
    {
        $validationResult = $this->jwtService->validate(null);
        $this->assertFalse($validationResult);
    }
}
