<?php

namespace Tests\Unit;

use App\ObjectFactory;
use Tests\TestCase;

class U05_JwtMiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        ObjectFactory::$useMocks = true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        ObjectFactory::$useMocks = false;
    }

    public function testSuccessAuthentication()
    {
        $this->markTestIncomplete();
    }

    public function testErrorAuthentication()
    {
        $this->markTestIncomplete();
    }
}
