<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reporte
 *
 * @property int $id
 * @property string $fecha
 * @property string $tipo
 * @property float $lat
 * @property float $lng
 * @property string $direccion
 * @property int $incidencias
 * @property string $estatus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereIncidencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reporte whereTipo($value)
 * @mixin \Eloquent
 * @property-read int|null $incidencias_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SeguimientoReporte[] $seguimientos
 * @property-read int|null $seguimientos_count
 */
class Reporte extends Model
{
    protected $table = 'reportes';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'tipo',
        'lat',
        'lng',
        'direccion',
        'incidencias',
        'estatus'
    ];

    public function seguimientos()
    {
        return $this->hasMany(SeguimientoReporte::class)->orderByDesc('fecha');
    }

    public function incidencias()
    {
        return $this->hasMany(IncidenciaReporte::class)->orderByDesc('fecha');
    }
}
