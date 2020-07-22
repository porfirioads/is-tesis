<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Usuario
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $email
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario wherePrimerApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereSegundoApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RolAdministrativo[] $roles
 * @property-read int|null $roles_count
 */
class Usuario extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->hasMany(RolAdministrativo::class);
    }
}
