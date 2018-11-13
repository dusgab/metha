<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Modo extends Model
{
    //
    protected $fillable = [
        'descripcion',
    ];

    public function oferta()
    {
        return $this->belongsTo('MOHA\Oferta', 'id_modo');
    }
}
