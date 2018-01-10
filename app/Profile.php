<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 7:39 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table='profiles';

    protected $fillable=['uid', 'name'];

}