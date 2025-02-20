<?php

use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: function () {
    return view(view: 'welcome');
});

Route::get(uri: '/about', action: function() {
    $name = 'shada';
    $departments = [
        '1' => 'Tichnical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];
    //return view('about', ['name' => $name]);
    //return view('about')->with('name', $name);
    return view(view: 'about', data: compact( 'name', 'departments'));
});

Route::post(uri: '/about', action: function() {
    $name = $_POST['name'];
    $departments = [
        '1' => 'Tichnical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];
    return view(view: 'about', data: compact(var_name: 'name'));
});


Route::get(uri: 'tasks', action: function() {
    $tasks = DB::table(table: 'tasks')->get();

    return view(view: 'tasks', data: compact('tasks'));
});

Route::post(uri: 'create', action: function(): string{
    $task_name = $_POST['name'];
    DB::table(table: 'tasks')->insert(values: ['name' => $task_name]);
    return redirect()->back();
});

Route::post(uri: 'delete/{id}', action: function($id) {
    DB::table(table: 'tasks')->where(column: 'id', operator: $id)->delete();
    return redirect()->back();
});

Route::post(uri: 'edit/{id}', action: function($id) {
    $task = DB::table(table: 'tasks')->where(column: 'id', operator: $id)->first();
    $tasks = DB::table(table: 'tasks')->get();
    return view(view: 'tasks', data: compact('task', 'tasks'));

});

Route::post(uri: 'update', action: function() {
    $id = $_POST['id'];
    DB::table(table: 'tasks')->where('id','=', $id)->update(['name' => $_POST['name']]);
    return redirect(to: 'tasks');

});