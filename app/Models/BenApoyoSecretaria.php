<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BenApoyoSecretaria
 *
 * @property int $id
 * @property int $apoyo_id
 * @property int $secretaria_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria whereApoyoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BenApoyoSecretaria whereSecretariaId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BenApoyo $apoyo
 * @property-read \App\Models\Secretaria $secretaria
 */
class BenApoyoSecretaria extends Model
{
    protected $table = 'ben_apoyos_secretarias';
    public $timestamps = false;

    protected $fillable = [
        'apoyo_id',
        'secretaria_id'
    ];

    public function apoyo()
    {
        return $this->belongsTo(BenApoyo::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }
}
