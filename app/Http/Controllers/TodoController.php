<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    

    public function index() {

    	return Todo::where('is_deleted', 0)->get();
    }


    public function create(Request $request) {
    	
    	$todo = new Todo;
    	$todo->body = $request->body;
    	$todo->save();
    	return $todo;
    }



    public function show($id) {
    	
    	return Todo::find($id);
    }



    public function update(Request $request, $id) {

    	$todo = Todo::find($id);
    	// $todo->body = $request->body;
    	$todo->is_completed = $request->is_completed;
    	$todo->save();
    	return $todo;
    	
    }



    public function delete($id) {

    	$todo = Todo::find($id);
    	$todo->is_deleted = 1;
    	return $todo->save() ? 'True' : 'False';    	
    }



}
