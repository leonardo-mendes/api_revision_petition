<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{

    protected $fillable = ['num_petition', 'desc_petition', 'id_user'];

    protected $hidden = ['created_at', 'updated_at'];

    public function results(){
            return $this->hasOne('App\Result', 'id_petition');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
