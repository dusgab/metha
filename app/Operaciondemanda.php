<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Operaciondemanda extends Model
{
    //
     protected $fillable = [
        'id_contra', 'fecha', 'tipo',
    ];

    public function contra()
    {
        return $this->hasOne('MOHA\Contrademanda', 'id', 'id_contra');
    }
}
