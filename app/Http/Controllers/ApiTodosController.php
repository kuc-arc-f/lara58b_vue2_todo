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
    public function __construct(){
        $this->TBL_LIMIT = 500;
    }
    /**************************************
     *
     **************************************/
    public function index()
    {   
//exit();
        $todos = Todo::orderBy('id', 'desc')
        ->limit($this->TBL_LIMIT)
        ->get();
        return response()->json($todos);
    }    
    /**************************************
     *
     **************************************/    
    public function search(Request $request){
        $data = $request->all();
//return response()->json( $data  );        
        $todos = Todo::where("title", "like", "%" . $data["search_key"] . "%" )
        ->orderBy('id', 'desc')
        ->limit($this->TBL_LIMIT)
        ->get();
        return response()->json( $todos  );
    }
    /**************************************
     *
     **************************************/   
    public function test1(){
        /*
        $todos = Todo::where("title", "A")
        ->orderBy('id', 'desc')
        ->get();
debug_dump($todos);
        */
exit();
    } 

}
