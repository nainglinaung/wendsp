<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class e_book extends Model
{
    protected $primaryKey='e_book_id';
    public function author()
    {
        return $this->belongsTo('App\author');
    }

    public function edition()
    {
        return $this->belongsTo('App\edition');
    }

    public function publisher()
    {
        return $this->belongsTo('App\publisher');
    }

    public function category()
    {
        return $this->hasMany('App\e_book_category');
    }

    public function comment()
    {
        return $this->hasMany('App\e_book_comment');
    }
}
