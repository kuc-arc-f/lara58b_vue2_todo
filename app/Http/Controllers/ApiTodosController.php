<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Todo;
//
class ApiTodosController extends Controller
{
    /**************************************
     *
     **************************************/
    //Request $request
    public function index()
    {   
        $todos = Todo::orderBy('id', 'desc')->get();
        return response()->json($todos);
    }    
     

}
