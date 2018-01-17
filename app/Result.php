<?php

namespace Everis;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['action_result','id_petition'];
    
    public function questions(){
            return $this->belongsto('Everis\Petition', 'id_petition');
    }
}
