<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/18/2017
 * Time: 11:36 AM
 */

namespace App\Http\Controllers;


use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BillingController extends Controller
{
    function index(){
        $user_id = Auth::user()->id;
        $transactions = Transaction::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

        return view('billing.index',[
            'transactions' => $transactions
        ]);
    }


    function addFund(Request $request){
        $input = \Illuminate\Support\Facades\Request::all();

        $afterTransaction = Transaction::orderBy('id', 'DESC')->first();

        $key = null;

        if($afterTransaction == null){
            $key = 1;
        }else{
            $key = $afterTransaction->id + 1;
        }

        $content = crc32(md5($key));

        $input['content'] = 'P' . str_replace('-', '', $content);
        $input['status'] = 'waiting';
        $input['user_id'] = Auth::user()->id;


        Transaction::create($input);


        return redirect('billing#modal')->with('txnId', $key);

    }


}