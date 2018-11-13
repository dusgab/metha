<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Contraoferta extends Model
{
    protected $fillable = [
        'id_oferta', 'id_comprador', 'cantidad', 'precio', 'id_cobro', 'plazo', 'id_puesto', 'estado',
    ];

    public function oferta()
    {
        return $this->belongsTo('MOHA\Oferta', 'id_oferta'); //
    }

    public function user()
    {
        return $this->belongsTo('MOHA\User', 'id_comprador'); //return $this->belongsTo('MOHA\User', 'id', 'id_comprador');
    }

    public function cobro()
    {
        return $this->hasOne('MOHA\Cobro', 'id', 'id_cobro');
    }

    public function puesto()
    {
        return $this->hasOne('MOHA\Puesto', 'id', 'id_puesto');
    }

}
