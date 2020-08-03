<?php


namespace Tests\Unit;


use App\Utils\Strings;
use Tests\TestCase;

class U14_StringsUtilsTest extends TestCase
{
    public function testUncamelizeString()
    {
        $original = 'HolaMundoComoEstan';
        $uncamelized = Strings::uncamelize($original);
        $expected = 'hola_mundo_como_estan';
        $this->assertEquals($expected, $uncamelized);
    }
}
