<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    //
    protected $fillable = [
        'descripcion',
    ];
    
    //
    public function user()
    {
        return $this->hasMany('MOHA\User', 'id', 'tipo_us');
    }
}
