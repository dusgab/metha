<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Contrademanda extends Model
{
    //
    protected $fillable = [
        'id_demanda', 'id_comprador', 'cantidad', 'precio', 'id_cobro', 'plazo', 'id_puesto', 'estado',
    ];

    public function demanda()
    {
        return $this->belongsTo('MOHA\Demanda', 'id_demanda'); //
    }

    public function user()
    {
        return $this->belongsTo('MOHA\User', 'id_comprador'); //
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
