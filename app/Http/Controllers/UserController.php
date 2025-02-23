<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;  // إضافة الاستدعاء لتشفير كلمة المرور

class UserController extends Controller
{
    // دالة عرض المستخدمين
    public function index() {
        $users = DB::table('users')->get(); // جلب المستخدمين من قاعدة البيانات
        return view('users', compact('users')); // إرجاع الواجهة مع المتغير
    }

    
    public function create(Request $request) {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', 
        ]);

        
        $name = $request->name ;
        $email = $request->email ;
        $password = $request->password ;
        

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,  
        ]);

        return redirect()->back();
    }

    
    public function destroy($id) {
        
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back();
    }


    public function edit($id) {
    
        $user = DB::table('users')->where('id', $id)->first();
        $users = DB::table('users')->get();
        return view('users', compact('user', 'users'));
    }

    // دالة لتحديث بيانات مستخدم
    public function update(Request $request) {
        // التحقق من صحة المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'nullable|string|min:8',  // كلمة المرور اختيارية عند التحديث
        ]);

        $id = $request->id;

        // تحضير البيانات للتحديث
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // إذا كان هناك كلمة مرور جديدة مدخلة، نقوم بتشفيرها وتحديثها
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password); // تشفير كلمة المرور
        }

        // تحديث المستخدم في قاعدة البيانات
        DB::table('users')->where('id', $id)->update($updateData);

        return redirect()->route('users');
    }
}
