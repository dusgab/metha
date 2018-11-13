<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $fillable = [
        'descripcion',
    ];

    public function producto()
    {
        return $this->hasMany('MOHA\Producto', 'id', 'id_cat');
    }
}
