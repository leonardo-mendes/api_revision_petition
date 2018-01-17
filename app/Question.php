<?php

namespace Everis;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['desc_question'];
    
    public function answers(){
            return $this->hasMany('Everis\Answer', 'id_question', 'next_question');
    }

    public function status(){
        return $this->hasOne('Everis\Status', 'id_status');
    }
}
