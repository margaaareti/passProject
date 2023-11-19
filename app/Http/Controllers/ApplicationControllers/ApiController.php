<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{

   public function index(){
       $foo = 'bar';
       return response()->json($foo);
   }

}
