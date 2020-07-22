<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RolAdministrativo
 *
 * @property int $id
 * @property string $rol
 * @property int $usuario_id
 * @property int $secretaria_id
 * @property-read \App\Models\Secretaria $secretaria
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo whereSecretariaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RolAdministrativo whereUsuarioId($value)
 * @mixin \Eloquent
 */
class RolAdministrativo extends Model
{
    protected $table = 'roles_administrativos';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol',
        'usuario_id',
        'secretaria_id'
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }
}
