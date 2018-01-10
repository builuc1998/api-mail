<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cl0ne extends Model
{
    protected $table = 'clone';

    protected $fillable = [
        'name',
        'uid',
        'email',
        'password',
        'cookie',
        'token',
        'status'
    ];
}
