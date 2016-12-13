<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book_category extends Model
{
	protected $table='book_category';

	protected $hidden = ['created_at','updated_at'];

	public function books()
    {
        return $this->hasMany('App\book');
    }    
}
