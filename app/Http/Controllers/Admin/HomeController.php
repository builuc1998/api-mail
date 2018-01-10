<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;

/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 10:05 AM
 */
class HomeController extends Controller
{
    public function index(){
        $users = User::all();

        echo json_encode($users);

    }

}