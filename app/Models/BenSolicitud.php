<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BenSolicitud
 *
 * @property int $id
 * @property string $fecha_solicitud
 * @property string|null $fecha_aceptacion
 * @property string|null $fecha_entrega
 * @property string $estatus
 * @property float|null $monto
 * @property string|null $evidencia
 * @property int $beneficiario_id
 * @property int $apoyo_secretaria_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereApoyoSecretariaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereBeneficiarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereEstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereEvidencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereFechaAceptacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereFechaEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereFechaSolicitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenSolicitud whereMonto($value)
 * @mixin \Eloquent
 */
class BenSolicitud extends Model
{
    protected $table = 'ben_solicitudes';
    public $timestamps = false;

    protected $fillable = [
        'fecha_solicitud',
        'fecha_aceptacion',
        'fecha_entrega',
        'estatus',
        'monto',
        'evidencia',
        'beneficiario_id',
        'apoyo_secretaria_id'
    ];

    public function beneficiario()
    {
        return $this->belongsTo(BenBeneficiario::class);
    }

    public function apoyoSecretaria()
    {
        return $this->belongsTo(BenApoyoSecretaria::class, 'apoyo_secretaria_id');
    }
}
