<?php

namespace App\Services;

/**
 * Contiene los valores de los campos de la base de datos cuyo tipo es una
 * enumeración.
 */
class DatabaseEnums
{
    public const RE_PENDIENTE = 'pendiente';
    public const RE_PROGRESO = 'en progreso';
    public const RE_ATENDIDO = 'atendido';
    public const RE_CANCELADO = 'cancelado';

    public const REPORTE_ESTATUS = [
        self::RE_PENDIENTE,
        self::RE_PROGRESO,
        self::RE_ATENDIDO,
        self::RE_CANCELADO,
    ];

    public const RT_BACHES = 'baches';
    public const RT_ILUMINACION = 'iluminación';
    public const RT_BASURA = 'basura';
    public const RT_SEGURIDAD = 'seguridad';
    public const RT_JIAPAZ = 'jiapaz';

    public const REPORTE_TIPO = [
        self::RT_BACHES,
        self::RT_ILUMINACION,
        self::RT_BASURA,
        self::RT_SEGURIDAD,
        self::RT_JIAPAZ,
    ];

    public const BEN_EST_PENDIENTE = 'pendiente';
    public const BEN_EST_APROBADO = 'aprobado';
    public const BEN_EST_DENEGADO = 'denegado';

    public const BEN_SOLICITUD_ESTATUS = [
        self::BEN_EST_PENDIENTE,
        self::BEN_EST_APROBADO,
        self::BEN_EST_DENEGADO
    ];
}
