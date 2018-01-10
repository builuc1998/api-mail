<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/18/2017
 * Time: 11:41 AM
 */

namespace App\Http\Controllers;


class ReportController extends Controller
{
    public function index(){
        return view('report.index');
    }

}