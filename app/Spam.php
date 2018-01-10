<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 10:50 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{

    protected $table = 'spam';

    protected $fillable = [
        'uid',
        'link',
        'profile_id',
        'frequency',
        'status'
    ];

}