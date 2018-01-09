<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['desc_question'];
    
    public function answers(){
            return $this->hasMany('App\Answer', 'id_question', 'next_question');
    }

    public function status(){
        return $this->hasOne('App\Status', 'id_status');
    }
}
