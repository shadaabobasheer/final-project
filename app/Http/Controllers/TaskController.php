<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index() {
        $tasks = DB::table(table: 'tasks')->get();

    return view(view: 'tasks', data: compact('tasks'));
    }

    public function create(Request $request) {
        $task_name = $request->input('name');
        DB::table('tasks')->insert(['name' => $task_name]);
        return redirect()->back();
    }
    public function destroy($id) {
        DB::table(table: 'tasks')->where(column: 'id', operator: $id)->delete();
    return redirect()->back();
    }

    public function edit($id)
{
    // جلب المهمة من قاعدة البيانات باستخدام ID
    $task = DB::table('tasks')->where('id', $id)->first();

    // جلب جميع المهام (يمكنك تعديل هذا حسب الحاجة)
    $tasks = DB::table('tasks')->get();

    // إرجاع الـ view مع المهمة والمهام الأخرى
    return view('tasks', compact('task', 'tasks'));
}


    // app/Http/Controllers/TaskController.php
    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');  // الحصول على الاسم الجديد للمهمة

        // تحديث المهمة في قاعدة البيانات
        DB::table('tasks')->where('id', $id)->update(['name' => $name]);

        // إعادة التوجيه إلى صفحة المهام
        return redirect()->route('tasks');  // هذا يعيد التوجيه إلى مسار "tasks"
    }


}
