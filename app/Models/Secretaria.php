<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Secretaria
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Secretaria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Secretaria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Secretaria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Secretaria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Secretaria whereNombre($value)
 * @mixin \Eloquent
 */
class Secretaria extends Model
{
    protected $table = 'secretarias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];
}
