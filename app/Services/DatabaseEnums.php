<?php

namespace App\Services;

/**
 * Contiene los valores de los campos de la base de datos cuyo tipo es una
 * enumeración.
 */
class DatabaseEnums
{
    public const RE_PENDIENTE = 'Pendiente';
    public const RE_PROGRESO = 'En progreso';
    public const RE_ATENDIDO = 'Atendido';
    public const RE_CANCELADO = 'Cancelado';

    public const RT_BACHES = 'Baches';
    public const RT_ILUMINACION = 'Iluminación';
    public const RT_BASURA = 'Basura';
    public const RT_SEGURIDAD = 'Seguridad';
    public const RT_JIAPAZ = 'JIAPAZ';

    public const REPORTE_ESTATUS = [
        self::RE_PENDIENTE,
        self::RE_PROGRESO,
        self::RE_ATENDIDO,
        self::RE_CANCELADO,
    ];

    public const REPORTE_TIPO = [
        self::RT_BACHES,
        self::RT_ILUMINACION,
        self::RT_BASURA,
        self::RT_SEGURIDAD,
        self::RT_JIAPAZ,
    ];
}
