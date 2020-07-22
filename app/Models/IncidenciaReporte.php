<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IncidenciaReporte
 *
 * @property int $id
 * @property string $fecha
 * @property string $foto
 * @property string|null $comentario
 * @property int $usuario_id
 * @property int $reporte_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereReporteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IncidenciaReporte whereUsuarioId($value)
 * @mixin \Eloquent
 */
class IncidenciaReporte extends Model
{
    protected $table = 'incidencia_reportes';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'foto',
        'comentario',
        'reporte_id',
        'usuario_id'
    ];
}
