<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
       // $tasks = DB::table(table: 'tasks')->get();
       $tasks = Task::all();

    return view(view: 'tasks', data: compact('tasks'));
    }

    public function create(Request $request) {
        $task_name = $request->input('name');
       // DB::table('tasks')->insert(['name' => $task_name]);
       $task = new Task;
       $task->name = $task_name;
       $task->save();
        return redirect()->back();
    }
    public function destroy($id) {
        //DB::table(table: 'tasks')->where(column: 'id', operator: $id)->delete();
    $task = Task::find($id);

    if ($task) {
        $task->delete();
    }

    return redirect()->back();
}



    public function edit($id)
{

    $task = DB::table('tasks')->where('id', $id)->first();


    $tasks = DB::table('tasks')->get();


    return view('tasks', compact('task', 'tasks'));
}



    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');


       // DB::table('tasks')->where('id', $id)->update(['name' => $name]);
       $id = $request->input('id');
       $name = $request->input('name');
       $task = Task::find($id);

       if ($task) {

           $task->name = $name;
           $task->save();
       }

        return redirect()->route('tasks');
    }


}
