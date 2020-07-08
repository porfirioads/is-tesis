<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolAdministrativo extends Model
{
    protected $table = 'roles_administrativos';

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
