<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    public function ciudad()
    {
        return $this->hasMany('MOHA\Ciudad', 'id', 'id_ciudad');
    }

    public function user()
    {
        return $this->hasMany('MOHA\User', 'id_provincia');
    }
}
