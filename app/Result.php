<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['action_result','id_petition'];
    
    public function questions(){
            return $this->belongsto('App\Petition', 'id_petition');
    }
}
