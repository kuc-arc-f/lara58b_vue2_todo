<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Libs\AppConst;
use App\Todo;

//
class TodosController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {
        return view('todos/index')->with('todos', null );
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('todos/create')->with('todo', new Todo());
    }    
    /*
    public function store(Request $request)
    {
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );
        $inputs = $request->all();
        $inputs["complete"] = 0;
        $inputs["user_id"] = $user_id;
        $todo = new Todo();
        $todo->fill($inputs);
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    */
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $task_id  = $id;
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        $complete_str = $complete_items[$todo->complete];
        //$task = Task::find($id);
        //return view('vue/tasks/show')->with('task_id', $id );
        return view('todos/show')->with(compact('task_id', 'complete_items', 'complete_str') );        
//        return view('todos/show')->with(compact('todo', 'complete_items') );        
    }    
    /**************************************
     *
     **************************************/
    private function get_complete_items(){
        $items =  array(
            '0' => '未完了', '1' => '完了済',
        );
        return $items;
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        return view('todos/edit')->with(compact('todo', 'complete_items') );
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->fill($request->all());
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    /**************************************
     *
     **************************************/
    public function delete(Request $request)
    {
        $data = $request->all();
//debug_dump($data["delete_id"]);
        $todo = Todo::find( $data["delete_id"] );
        $todo->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('todos.index');
    }

}
