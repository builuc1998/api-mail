<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/18/2017
 * Time: 11:42 AM
 */

namespace App\Http\Controllers;


class LogController extends Controller
{
    public function index(){
        return view('log.index');
    }

}