<?php


namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Representa esqueleto para la creación de TestCases donde se ejecurarán
 * migraciones y seeds de la base de datos solo una vez en el TestCase.
 */
class DatabaseOneTestCase extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private static $dbSeeded = false;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        DatabaseOneTestCase::$dbSeeded = false;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        DatabaseOneTestCase::$dbSeeded = false;
    }

    public function setUp(): void
    {
        parent::setUp();
        if (!DatabaseOneTestCase::$dbSeeded) {
            $this->seed();
            DatabaseOneTestCase::$dbSeeded = true;
        }
    }
}
