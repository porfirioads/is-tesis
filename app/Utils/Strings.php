<?php

namespace App\Utils;

/**
 * Contiene utilidades para el manejo de cadenas.
 */
class Strings
{
    public static function uncamelize($camel, $splitter = "_")
    {
        $camel = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0',
            preg_replace('/(?!^)[[:upper:]]+/', $splitter . '$0', $camel));
        return strtolower($camel);
    }
}
