<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 10:45 AM
 */

namespace App\Http\Controllers;


use App\Profile;
use App\Spam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpamController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $spams = Spam::where('uid', Auth::user()->id)->get();

        $profiles = Profile::where('uid', Auth::user()->id)->get();

        return view('spam.index', [
            'spams' => $spams,
            'profiles' => $profiles
        ]);
    }

    function add(Request $request){
        $input = \Illuminate\Support\Facades\Request::all();

        $input['uid'] = Auth::user()->id;

        Spam::create($input);

        return redirect('spam');

    }

    function updateStatus($id){
        $spam = Spam::findOrFail($id);

        $newStt = null;

        switch ($spam->status){
            case 'new' : $newStt = 'running'; break;
            case 'running' : $newStt = 'stopped'; break;
            case 'stopped' : $newStt = 'running'; break;
        }

        $spam->status = $newStt;
        $spam->save();

        return redirect('spam');
    }

}