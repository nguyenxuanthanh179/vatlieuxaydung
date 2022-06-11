<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'image', 'user_id', 'is_active', 'is_new', 'summary', 'description'];
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
