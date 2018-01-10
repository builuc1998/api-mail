<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clone2 extends Model
{
    
    protected $fillable = [
        'uid',
        'first',
        'last',
        'email',
        'name',
        'password',
        'cookie',
        'token',
        'sex',
        'status',
        'typecp',
        'birthday',
        'updated_at',
    ];
    protected $table = 'clone';
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at','sharedpost_at'];

    protected $dates  = ['deleted_at'];
}
