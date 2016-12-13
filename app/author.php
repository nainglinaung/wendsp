<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class author extends Model
{
	protected $primaryKey='author_id';

    public function books()
    {
        return $this->hasMany('App\book');
    }    


    public function e_books()
    {
        return $this->hasMany('App\e_book');
    }  
}
