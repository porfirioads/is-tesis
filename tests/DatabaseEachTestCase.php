<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Representa esqueleto para la creación de TestCases donde se ejecurarán
 * migraciones y seeds de la base de datos en cada una de las pruebas.
 */
class DatabaseEachTestCase extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
}
