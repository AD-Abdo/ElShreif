<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $rows = User::query()->where('role','=','0')->paginate();
        return view('admin.user.index',compact('rows'));
        
    }

    public function create()
    {
        return view('admin.user.create');
    }
    public function message()
    {
        return [
            'name.required'=>'يجب ادخال اسم المستخدم',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.unique' => 'البريد الالكتروني هاذ مسجل مسبقا',
            'password.required'=>'يجب ادخال كلمة المرور',
            'password.min'=>'كلمة المرور يجب ان لا تقل عن 8 أحراف او ارقام',
            'password.same'=>'كلمة المرور غير متطابقة',
            'role.required'=>'يجب اختيار رتبة المستخدم',
        ];
    }

    public function store(Request $request)
    {
        $request->merge([
            'email' => $request->text_email.'@elshreif.academy',
        ]);
        $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users',
            'password' => 'required|min:8|same:confirmPassword',
            'role' => 'required'
        ],$this->message());

        

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.user.create')->with('success','تم اضافة المستخدم '.$user->name.' للنظام بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success','تم حذف المستخدم من النظام بنجاح');
    }
}
