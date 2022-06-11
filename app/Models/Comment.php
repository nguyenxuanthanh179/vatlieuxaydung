<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public function product(){
        return $this->hasMany('App\Models\Product', 'product_id');
    }
    public function project(){
        return $this->hasMany('App\Models\Project', 'project_id');
    }
    public function article(){
        return $this->hasMany('App\Models\Article', 'article_id');
    }
}
