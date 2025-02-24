<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // View all the users
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    // make a new user
    public function store(Request $request)
{
    // التحقق من المدخلات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // إنشاء مستخدم جديد
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // إعادة التوجيه إلى قائمة المستخدمين مع رسالة نجاح
    return redirect()->route('users.index')->with('success', 'User created successfully!');
}

    //View user edit form
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $users = User::all(); // to view all the user in the table
        return view('edit', compact('user'));
    }

    // Update the user data
   // update a user data
public function update(Request $request, $id)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'nullable|string|min:8',  // Validate password only if provided
    ]);

    $user = User::findOrFail($id);  //

    // update the user data
    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    // if a password is a new
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);  //update a password
    }

    $user->update($data);  // update the data

    return redirect()->route('users.index')->with('success', 'The data of the user was updated');
}

    // delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'the user was deleted successfuly');
    }
}
