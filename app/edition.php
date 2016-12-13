<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class edition extends Model
{
	protected $primaryKey='edition_id';

    public function books()
    {
        return $this->hasMany('App\book');
    }    

    public function e_books()
    {
        return $this->hasMany('App\e_book');
    }  
}
