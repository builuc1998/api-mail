<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 11/17/2017
 * Time: 4:16 PM
 */

namespace App\Http\Controllers;

use App\Cl0ne;

class CloneProcessController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 3000);
    }

    public function readFileByLine(){

        $fns=[
            'tc20171028.txt',
            'tc20171029.txt',
            'tc20171030.txt',
            'tc20171031.txt',
            'tc20171101.txt',
            'tc20171102.txt',
            'tc20171103.txt',
            'tc20171104.txt',
            'tc20171105.txt',
            'tc20171106.txt',
        ];

        foreach ($fns as $fn){
            $handle = fopen(public_path() . '/clone/' . $fn  , "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    try{
                        $infos = explode('|', $line);

                        $name = $infos[0];
                        $uid = $infos[2];
                        $email = $infos[3];
                        $pw = $infos[4];
                        $cookie = $infos[5];
                        $token = $infos[6];

                        //create token
                        Cl0ne::create([
                            'name' => $name,
                            'uid' => $uid,
                            'email' => $email,
                            'password' => $pw,
                            'cookie' => $cookie,
                            'token' => $token,
                            'status' => ''
                        ]);
                    }catch (\Exception $exception){
                        echo $exception;
                    }


                }

                fclose($handle);
            } else {
                // error opening the file.
            }
        }


    }

}