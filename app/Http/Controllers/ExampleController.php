<?php

namespace App\Http\Controllers;
use illuminate\support\Facades\DB;
class ExampleController extends Controller
{
   function testconnection(){
       $getdb=DB::Connection()->select('SELECT * FROM students');
       return $getdb;
   }
}
