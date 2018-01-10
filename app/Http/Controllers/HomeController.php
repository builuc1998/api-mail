<?php

namespace App\Http\Controllers;

use App\Group;
use App\Profile;
use App\SocialFacebookAccount;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home-v1' );
    }

    public function profile(){
        $user = Auth::user();

        $profiles = Profile::where('uid', $user->id)->get();

        return \view('profiles',
            [

                'profiles' => $profiles
            ]
        );
    }

    public function addProfile(){
        return view('add-profile');
    }

    public function postAddProfile(\Illuminate\Http\Request $request){
        $input = Request::all();

        $input['uid'] = Auth::user()->id;

        $groupid_raw = $request->groupid;

        $charSet = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $groupid_raw);
        $charSet = rtrim($charSet);
        $groupids = explode(" ", $charSet);


        Profile::create($input);

        $lastProfile = Profile::orderBy('id', 'DESC')->first();

        foreach ($groupids as $groupid){
            Group::create([
                'groupid' => $groupid,
                'profile_id' => $lastProfile->id
            ]);
        }

        return redirect('profile');
    }

    public function viewProfile($id){
        $profile = Profile::findOrFail($id);

        $groups = Group::where('profile_id',$profile->id )->get();



        return view('view-profile',[
            'profile' => $profile,
            'groups' => $groups
        ]);
    }

    public function postEditProfile($id){

    }

    public function delProfile($id){
        Profile::destroy($id);

        return redirect('profile');
    }
}
