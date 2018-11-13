<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    public function user()
    {
        return $this->hasMany('MOHA\User', 'id_ciudad');
    }

    public function provincia()
    {
        return $this->belongsTo('MOHA\Provincia', 'id_provincia');
    }

    public static function getCiudades($id) {
    	return Ciudad::where('id_provincia', '=', $id)->orderBy('nombre', 'ASC')->distinct()->get();
    	
    }
}
