<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // định nghĩa quan hệ giữa bảng danh muc- sản phảm
    // một sản phẩm  thuộc về 1 danh mục
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
