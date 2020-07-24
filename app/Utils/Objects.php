<?php

namespace App\Utils;

/**
 * Implementa utilidades para el manejo de objetos.
 */
class Objects
{
    /**
     * Obtiene los nombres de los atributos de un objeto.
     *
     * @param $object
     * @return array
     */
    public static function getObjectKeys($object)
    {
        $array = get_object_vars($object);
        $properties = array_keys($array);
        return $properties;
    }
}
