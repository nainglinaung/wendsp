<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
protected $table='books';

protected $primaryKey='book_id';

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
        return $this->hasMany('App\book_category');
    }

    public function best_selling_category()
    {
        return $this->hasMany('App\book_category');
    }

    public function comment()
    {
        return $this->hasMany('App\comment');
    }
}
