<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BenBeneficiario
 *
 * @property int $id
 * @property string $nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $sexo
 * @property string $curp
 * @property string|null $telefono
 * @property string $nombre_vialidad
 * @property string $numero_exterior
 * @property string|null $numero_interior
 * @property string $colonia
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereColonia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereCurp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereNombreVialidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereNumeroExterior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereNumeroInterior($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario wherePrimerApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereSegundoApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenBeneficiario whereTelefono($value)
 * @mixin \Eloquent
 */
class BenBeneficiario extends Model
{
    protected $table = 'ben_beneficiarios';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'sexo',
        'curp',
        'telefono',
        'nombre_vialidad',
        'numero_exterior',
        'numero_interior',
        'colonia',
    ];
}
