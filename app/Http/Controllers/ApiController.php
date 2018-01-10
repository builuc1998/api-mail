<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 4:57 PM
 */

namespace App\Http\Controllers;


use App\Cl0ne;
use App\Group;
use App\Profile;
use App\Result;
use App\Spam;
use App\User;
use App\clone2;
use App\mail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    function __construct()
    {

    }


    function joinGroup(){
        $oldestSpam = Spam::orderBy('updated_at', 'ASC')->first();

        $user = User::findOrFail($oldestSpam->uid);

        $profileId = $oldestSpam->profile_id;

        $profile = Profile::findOrFail($profileId);

        //check if have not group in profile
        if (Group::where('profile_id', $profileId)->count() == 0){
            return \response()->json(['error' => 'haven\'t group in profile'], 200);
        }

        $oldestGroupOfSpam = Group::where('profile_id', $profileId)->orderBy('updated_at', 'ASC')->first();

        $oldestClone = Cl0ne::orderBy('updated_at', 'ASC')->first();

        if ($oldestClone == null){
            return \response()->json(['error' => 'clone occurred a error'], 200);
        }


        $res = [
           // 'email' => $user->email,

            'userid' => $user->id,
            'profile_name' => $profile->name,
            'uid' => $oldestClone->uid,
            'token' => $oldestClone->token,
            'groupid' => $oldestGroupOfSpam->groupid,
            'action' => 'joingroup'
        ];

        $oldestSpam->updated_at = date('Y-m-d H:i:s');
        $oldestSpam->save();

        $oldestGroupOfSpam->updated_at = date('Y-m-d H:i:s');
        $oldestGroupOfSpam->save();

        $oldestClone->updated_at = date('Y-m-d H:i:s');
        $oldestClone->save();

        return response()->json($res, 200);


    }

    function cloneUpdate(){
        $uid = Input::get('uid');
        $status = Input::get('status');

        $cl0ne = Cl0ne::where('uid', $uid)->first();

        $cl0ne->status = $status;

        $cl0ne->save();

        return response()->json($cl0ne, 200);
    }

    /**
     *
     */
    function doResult(){
        $content = Input::get('content');

        Result::create([
            'value' => $content
        ]);

        return 'true';

    }

    public function upClone()
    {
        $uid = Input::get('uid');
        $first = Input::get('first');
        $last = Input::get('last');
        $email = Input::get('email');
        $pass = Input::get('pass');
        $cookie = Input::get('cookie');
        $token = Input::get('token');
        $sex = Input::get('sex');
        $birthday = Input::get('birthday');

        $user = clone2::create([
            'uid' => $uid,
            'first' => $first,
            'last' => $last,
            'name' => $first .' '.$last,
            'email' => $email,
            'password' => $pass,
            'cookie' => $cookie,
            'token' => $token,
            'sex' => $sex,
            'birthday' => $birthday,
            'status' => 'new',
            'typecp' => 'not'
        ]);
        return response()->json(['success' => true], 200);
    }

    public function getClone() {
        $first = DB::table('clone')->orderBy('updated_at', 'asc')->take(1)->lockForUpdate()->get();
        if (!isset($first[0])) {
            return response()->json(['success' => false], 200);
        }

        \Log::error('ID ' . $first[0]->id);
        DB::update('update clone set updated_at = "'. date('Y-m-d H:i:s') .'" where id = ' . $first[0]->id);
        return response()->json(['success' => true, 'data' => $first[0]], 200);
    }
    public function emptyClone(){
        Cl0ne::truncate();
        return response()->json(['success' => true], 200);
    }
    public function postCode(){
        $email = Input::get('email');
        $code = Input::get('code');
        $link = Input::get('link');
        if($email == '' || $code == '' || $link == ''){
            return response()->json(['success' => false,'msg'=>'Không đủ thông tin.'], 301);
        }
        $query = mail::create([
            'email' => $email,
            'code' => $code,
            'link' => $link
        ]);
        return response()->json(['success' => true], 200);
    }
    function getCode($email){
        $code = DB::table('code_mail')->where('email',$email)->orderBy('created_at', 'asc')->take(1)->lockForUpdate()->get();
        if (!isset($code[0])) {
            return response()->json(['success' => false], 200);    
        }
        return response()->json(['success' => true, 'code' => $code[0]->code], 200);
    }
    
    function updateClone(){
        $uid = Input::get('uid');
        $value = Input::get('value');
        $key = Input::get('key');
        $cl0ne = Cl0ne::where('uid', $uid)->first();

        $cl0ne->$key = $value;

        $cl0ne->save();

        return response()->json($cl0ne, 200);
    }
    function getByStatus(){
        $first = DB::table('clone')->where('status',Input::get('status'))->orderBy('updated_at', 'asc')->take(1)->lockForUpdate()->get();
        if (!isset($first[0])) {
            return response()->json(['success' => false], 200);
        }

        \Log::error('ID ' . $first[0]->id);
        DB::update('update clone set updated_at = "'. date('Y-m-d H:i:s') .'" where id = ' . $first[0]->id);
        return response()->json(['success' => true, 'data' => $first[0]], 200);
    }
}