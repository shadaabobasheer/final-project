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
    return view(view: 'tasks');
});

Route::post(uri: 'create', action: function(): string{
    $task_name = $_POST['name'];
    DB::table(table: 'tasks')->insert(values: ['name' => $task_name]);
    return view(view: 'tasks') ;
});