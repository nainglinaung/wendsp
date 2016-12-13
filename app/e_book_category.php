<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class e_book_category extends Model
{
	protected $table="e_book_category";

	public function books()
    {
        return $this->hasMany('App\e_book');
    } 
}
