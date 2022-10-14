<?php

namespace App\Http\Controllers;
use App\Models\registration;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class LoginController extends Controller
{
    function register(Request $request){
        $f_name= $request->input('f_name');
        $l_name= $request->input('l_name');
        $user_name= $request->input('user_name');
        $email= $request->input('email');
        $password= $request->input('password');
        $counta=registration::where('email',$email)->count();
        $countb=registration::where('user_name',$user_name)->count();
        if($counta !=0){
          return "this email is alraedy exist";
        }
        elseif($countb !=0){
          return "this User Name is alraedy exist";
        }
        else{
          $result =registration::insert([
               'f_name'=>$f_name,
               'l_name'=>$l_name,
               'user_name'=>$user_name,
               'email'=>$email,
               'password'=>$password,
          ]);
        }
     }
    function onlogin(Request $request){
        
        $password= $request->input('password');
        $user_name= $request->input('user_name');
        $count=registration::where(['user_name'=>$user_name,'password'=>$password])->count();
        if($count == 1){
            $key=env('TOKEN_KEY');
            $payload = [
                'site' => 'http://hasanlumen.org',
                'user_name' => $user_name,
                'iat' => time(),
                'exp' => time()+48000
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
           
            return response()->json(['Token'=>$jwt,'status'=>'Loged In']);
        }
        else{
            return 'no';
        }
    }
}
