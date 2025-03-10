<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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

// routes/web.php
Route::get('tasks', [TaskController::class, 'index'])->name('tasks');

Route::post('create-task', [TaskController::class, 'create'])->name('create-task');

Route::post('delete-task/{id}', [TaskController::class, 'destroy'])->name('delete-task');

// routes/web.php
Route::get('edit-task/{id}', [TaskController::class, 'edit'])->name('edit-task');

// routes/web.php
Route::post('update-task', [TaskController::class, 'update'])->name('update-task');

Route::get(uri: 'app', action: function() {
     return view(view: 'layouts.app');
});

Route::get(uri: 'users', action: [UserController::class, 'index']);

Route::post('create-user', [UserController::class, 'create']);

Route::post(uri: 'delete/{id}', action: [UserController::class, 'destroy']);

Route::post(uri: 'edit/{id}', action: [UserController::class, 'edit']);

Route::post(uri: 'update', action: [UserController::class, 'update']);


