<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function articles(){
        return $this->hasMany('App\Models\Article');
    }
    public function projects(){
        return $this->hasMany('App\Models\Article');
    }
    public function banners(){
        return $this->hasMany('App\Models\Banner');
    }
    public function vendors(){
        return $this->hasMany('App\Models\Vendor');
    }
    public function products(){
        return $this->hasMany('App\Models\Product');
    }
    public function categories(){
        return $this->hasMany('App\Models\Category');
    }
}
