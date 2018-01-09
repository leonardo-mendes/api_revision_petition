<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['desc_action'];
    
    public function answers(){
            return $this->belongsto('App\Answer', 'id_answer');
    }
}
