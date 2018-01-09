<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['desc_answer'];
    
    public function questions(){
        return $this->belongsto('App\Question', 'id_question', 'next_question');
    }

    public function actions(){
        return $this->hasMany('App\Action', 'id_answer');
    }
}
