<?php

namespace MOHA;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    //
	protected $fillable = [
        'id_user',
    ];
    
    //
    public function user()
    {
        return $this->belongsTo('MOHA\User', 'id_user');
    }
}
