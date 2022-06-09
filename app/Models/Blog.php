<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

	protected $fillable = [
	   'title', 'category_id','sub_category_id','description', 'image', 'status'
	];

	//hasMany relation with Blogtag Model
	public function tags(){
    	return $this->hasMany(Blogtag::class);
	}
    public function suburb(){
    	return $this->hasOne(Suburb::class, 'id', 'suburb_id');
	}
	//hasOne relation with Blogcategory Model
	public function category(){
	    return $this->hasOne(Blogcategory::class, 'id', 'category_id');
	}
    public function subcategory() {
        return $this->hasOne(Blogsubcategory::class,  'id','sub_category_id');
    }
}
