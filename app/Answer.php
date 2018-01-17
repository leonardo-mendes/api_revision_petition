<?php

namespace Everis;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['desc_answer'];
    
    public function questions(){
        return $this->belongsto('Everis\Question', 'id_question', 'next_question');
    }

    public function actions(){
        return $this->hasMany('Everis\Action', 'id_answer');
    }
}
