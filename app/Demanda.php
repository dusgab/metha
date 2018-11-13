<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    protected $fillable = [
        'id_op', 'id_prod', 'id_modo', 'peso', 'id_medida', 'cantidad','cantidadOriginal', 'precio', 'fechaEntrega', 'id_puesto', 'id_cobro', 'abierta',
    ];

    public function user()
    {
        return $this->belongsTo('MOHA\User', 'id_op'); //
    }

    public function producto()
    {
        return $this->hasOne('MOHA\Producto', 'id', 'id_prod');
    }

    public function puesto()
    {
        return $this->hasOne('MOHA\Puesto', 'id', 'id_puesto');
    }

    public function cobro()
    {
        return $this->hasOne('MOHA\Cobro', 'id', 'id_cobro');
    }

    public function modo()
    {
        return $this->hasOne('MOHA\Modo', 'id', 'id_modo');
    }

    public function medida()
    {
        return $this->hasOne('MOHA\Medida', 'id', 'id_medida');
    }

    public function contrademanda()
    {
        return $this->hasMany('MOHA\Contradmanda', 'id_demanda', 'id');
    }
}
