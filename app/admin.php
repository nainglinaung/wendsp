<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class admin extends Model implements Authenticatable
{
    protected $table='admins';
	protected $fillable = ['username', 'password'];

    use AuthenticableTrait;
}
