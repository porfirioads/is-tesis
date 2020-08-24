<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BenApoyo
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyo whereNombre($value)
 * @mixin \Eloquent
 */
class BenApoyo extends Model
{
    protected $table = 'ben_apoyos';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
