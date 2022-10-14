<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\phone_book;
use Carbon\Carbon;
class phonebookController extends Controller
{
  // php -S localhost:8000 -t public
//  function fulks(){
//     $result = DB::table('students')->pluck('name','roll');
//     return $result;
//  }
 function test(){
  return 'ok';
 }
 function oninsert(Request $request){
    $details =$request->input('details');
    $number =$request->input('number');
    $token =  $request->input('access_token');
    $key=env('TOKEN_KEY');
    $decoded = JWT::decode($token, new Key($key, 'HS256'));
    $decoded_array=(array)$decoded;
    $data= $decoded_array['user_name'];
    $result = phone_book::insert([
          'user_name'=>$data,
           'details'=>$details, 
           'number'=>$number, 
    ]);
    if($result ==1 ){
       return 'ok';
    }
 }
 
 function onselect(Request $request){
  $token =  $request->input('access_token');
  $key=env('TOKEN_KEY');
  $decoded = JWT::decode($token, new Key($key, 'HS256'));
  $decoded_array=(array)$decoded;
  $data= $decoded_array['user_name'];
  $result =phone_book::where('user_name',$data)->get();
  return $result;
 }
 
 function ondelete(Request $request){
  $token =  $request->input('access_token');
  $key=env('TOKEN_KEY');
  $decoded = JWT::decode($token, new Key($key, 'HS256'));
  $decoded_array=(array)$decoded;
  $data= $decoded_array['user_name'];
  $result =phone_book::where('user_name',$data)->delete();
  if($result == 1){
    return 'hassan';
  }
 }
}
