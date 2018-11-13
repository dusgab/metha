<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Operacionoferta extends Model
{
    //
    protected $fillable = [
        'id_contra', 'fecha', 'tipo',
    ];

    public function contra()
    {
        return $this->hasOne('MOHA\Contraoferta', 'id', 'id_contra');
    }
}
