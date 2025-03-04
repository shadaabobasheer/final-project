<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
{
    $users = DB::table('users')->get();
    return view('users', compact('users'));
}

    public function create(Request $request){
        $user_name = $request->input('name');
        $user_email = $request->input('email');
        $user_password = $request->input('password');

        DB::table('users')->insert([
            'name' => $user_name,
            'email' => $user_email,
            'password' => bcrypt($user_password), // تأكد من تشفير كلمة المرور
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        DB::table(table: 'users')->where(column: 'id', operator: $id)->delete();
        return redirect()->back();
    }

    public function edit($id){
    $user = DB::table(table: 'users')->where(column: 'id', operator: $id)->first();
    $users = DB::table(table: 'users')->get();
    return view('users', compact('user', 'users'));
}
public function update(){
    $id = $_POST['id'];
    DB::table(table: 'users')->where('id', '=', $id)->update(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
    return redirect(to: 'users');
}
}
