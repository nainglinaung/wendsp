<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
	protected $primaryKey="category_id";
    public function book()
    {
        return $this->hasMany('App\book_category');
    }    

    public function e_book()
    {
        return $this->hasMany('App\e_book_category');
    }    

    public function book_category()
    {
        return $this->hasMany('App\book_category');
    }    
    public function best_selling_category()
    {
        return $this->hasMany('App\book_category');
    }    
}
