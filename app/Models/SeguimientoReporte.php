<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SeguimientoReporte
 *
 * @property int $id
 * @property string $fecha
 * @property string $foto
 * @property string|null $comentario
 * @property int $usuario_id
 * @property int $reporte_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereReporteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereUsuarioId($value)
 * @mixin \Eloquent
 * @property string $estatus
 * @property string $mensaje
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeguimientoReporte whereMensaje($value)
 */
class SeguimientoReporte extends Model
{
    protected $table = 'seguimiento_reportes';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'mensaje',
        'estatus',
        'reporte_id'
    ];
}
