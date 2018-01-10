<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mail extends Model
{
    protected $table = 'code_mail';
    protected $fillable = ['email','code','link'];
}
