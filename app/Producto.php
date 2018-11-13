<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $table = 'productos';

    protected $fillable = [
        'nombre', 'descripcion', 'descripcion2', 'id_cat',
    ];

    public function oferta()
    {
        return $this->belongsTo('MOHA\Oferta', 'id_prod');
    }

    public function demanda()
    {
        return $this->belongsTo('MOHA\Demanda', 'id_prod');
    }

    public function categoria()
    {
        return $this->belongsTo('MOHA\Categoria', 'id_cat');
    }
}
