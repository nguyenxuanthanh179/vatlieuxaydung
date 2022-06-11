<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
