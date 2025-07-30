<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
function submitform(Request $request){
return $request->all();
    }
}
