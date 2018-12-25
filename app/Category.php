<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function products()
    {
    	return $this->belongsToMany('App\Product');
    }

    public function childerns(){
    	return $this->belongsToMany(Category::class,'category_parent','category_id','parent_id');
    }
}
