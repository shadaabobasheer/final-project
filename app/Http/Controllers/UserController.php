<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

    public function index()
{
    //$users = DB::table('users')->get();
      $users = User::all();
    return view('users', compact('users'));
}

    public function create(Request $request){
        $user_name = $request->input('name');
        $user_email = $request->input('email');
        $user_password = $request->input('password');

        //DB::table('users')->insert([
            //'name' => $user_name,
            //'email' => $user_email,
            //'password' => bcrypt($user_password), // تأكد من تشفير كلمة المرور
      //  ]);
      $user = new User;
      $user->name = $user_name;
      $user->email = $user_email;
      $user->password = $user_password;
      $user->save();
        return redirect()->back();
    }

    public function destroy($id){
        //DB::table(table: 'users')->where(column: 'id', operator: $id)->delete();
        $user = User::find($id);
    if ($user) {
        $user->delete();
    }
        return redirect()->back();
    }

    public function edit($id){
    $user = DB::table(table: 'users')->where(column: 'id', operator: $id)->first();
    $users = DB::table(table: 'users')->get();
    return view('users', compact('user', 'users'));
}

public function update(Request $request){
    $id = $_POST['id'];
    //DB::table(table: 'users')->where('id', '=', $id)->update(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
    $id = $request->input('id');
       $name = $request->input('name');
       $email = $request->input('email');
       $password = $request->input('password');
       $user = User::find($id);

       if ($user) {
           $user->name = $name;
           $user->email = $email;
           if ($password) {
            $user->password = bcrypt($password);
           }
           $user->save();
       }

       return redirect(to: 'users');


}
}
