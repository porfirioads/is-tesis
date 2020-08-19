<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * TestCase para la creación de pruebas donde se requiere inicialización de
 * la base de datos.
 */
class DatabaseTestCase extends TestCase
{
//    use RefreshDatabase;
//    use DatabaseMigrations;

    private static $dbSeeded = false;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        DatabaseTestCase::$dbSeeded = false;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        DatabaseTestCase::$dbSeeded = false;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        if (!DatabaseTestCase::$dbSeeded) {
            $this->artisan('migrate:fresh --seed');
            DatabaseTestCase::$dbSeeded = true;
        }
    }
}
