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

Route::get(uri: 'tasks', action: [TaskController::class, 'index']);


Route::post(uri: 'create', action: [TaskController::class, 'create']);


Route::post(uri: 'delete/{id}', action: [TaskController::class, 'destroy']);

Route::post(uri: 'edit/{id}', action: [TaskController::class, 'edit']);


Route::post(uri: 'update', action: [TaskController::class, 'update']);

Route::get(uri: 'app', action: function() {
     return view(view: 'layouts.app');
});

// Route::get('users', [UserController::class, 'index'])->name('users');
// Route::post('create-user', [UserController::class, 'create']);
// Route::post('delete-user/{id}', [UserController::class, 'destroy']);
// Route::post('edit-user/{id}', [UserController::class, 'edit']);
// Route::post('update-user', [UserController::class, 'update']);

Route::resource('users', UserController::class);

// View A user menu
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Add a new user
Route::post('/users', [UserController::class, 'create'])->name('users.store');

// delete a user
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Edit a user data
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

//Update a user data
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');



