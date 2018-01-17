<?php

namespace Everis;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['desc_action'];
    
    public function answers(){
            return $this->belongsto('Everis\Answer', 'id_answer');
    }
}
