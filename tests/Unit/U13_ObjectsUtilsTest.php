<?php

namespace Tests\Unit;

use App\Models\Usuario;
use App\Utils\Objects;
use Tests\TestCase;

// phpcs:ignore
class U13_ObjectsUtilsTest extends TestCase
{
    public function testUsuarioHasCorrectAttributes()
    {
        $usuario = new Usuario();
        $attributes = Objects::getObjectKeys($usuario);
        $expected = ['timestamps', 'incrementing', 'exists', 'wasRecentlyCreated'];
        $this->assertEquals($expected, $attributes);
    }
}
