<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Row;
use App\Models\Salary;
use App\Models\Subject;
use App\Models\Table;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('admin.index');
    }
    public function editProfile()
    {
        return view('admin.editProfile');
    }

    public function editProfilePost(Request $request)
    {
        if($request->name == null){
            return redirect()->route('admin.edit.profile')->with('error','لم يتم تغيير اسم حسابك لانك تركت خانة الاسم فارغة');
        }
        else if($request->name == Auth::user()->name){
            return redirect()->route('admin.edit.profile')->with('error','لم يتم تغيير اسم حسابك لعدم التغيير فى البيانات');   
        }
        else{
            $row = User::findOrFail(Auth::user()->id);
            $row->name = $request->name;
            $row->save();
            return redirect()->route('admin.edit.profile.post')->with('success','تم تغيير اسم حسابك بنجاح');
        }
        
        
    }
    public function editPassword()
    {
        return view('admin.editPassword');
    }

    public function editPasswordPost(Request $request)
    {
        
        if($request->password == null && $request->confirmPassword == null){
            return redirect()->route('admin.edit.password')->with('error','لم يتم تغيير كلمة مرور حسابك لعدم التغيير فى البيانات'); 
        }
        else if(Str::length($request->password) < 8){
            return redirect()->route('admin.edit.password')->with('error','كلمة المرور يجب ان تحتوى على اكثر من 8 أحرف او ارقام'); 
        }
        else if($request->password != $request->confirmPassword){            
            return redirect()->route('admin.edit.password')->with('error','لم يتم تغيير كلمة مرور حسابك لعدم تطابق كلمتى المرور');   
        }
        else{
            $password = Hash::make($request->password);
            if($password == Auth::user()->password){
                return redirect()->route('admin.edit.password')->with('error','لم يتم تغيير كلمة مرور حسابك لاننك ادخلت كلمة المرور الحالية');
            }else{
                $row = User::findOrFail(Auth::user()->id);
                $row->password = $password;
                $row->save();
                return redirect()->route('admin.edit.password.post')->with('success','تم تغيير كلمة مرور حسابك بنجاح');
            }
            
        }
        
        
    }
    public function data()
    {
        $count_tables = count(Table::get()->all());
        $count_subjects = count(Subject::get()->all());
        $count_teachers = count(Teacher::get()->all());
        return response()->json([
            'count_tables' => $count_tables,  
            'count_subjects' => $count_subjects,  
            'count_teachers' => $count_teachers,                
            
        ]);
    }

    public function RowData()
    {
        
        $rows = Row::get()->all();
        $rows_data =[];
        foreach($rows as $row){
            array_push($rows_data,['row'=>$row->name,'count_students' => count($row->Students)]);
        }
        
        
        return response()->json([
            'rows' => $rows_data                
            
        ]);
        
        
    }
    public function Attendance()
    {
        $rows = Row::get()->all();
        $rows_student_attendance = [];
        $count_student_attendance =0 ;
        $date = '20'.date('y-m-d');
        foreach($rows as $row){   
            foreach($row->Students as $student){
                if($student->StudentAttendance != null){
                    foreach($student->StudentAttendance as $attendance){
                        if($attendance->date == $date){
                            $count_student_attendance = $count_student_attendance +1 ;
                        }
                    }
                }
            }
            if(in_array($row->name,$rows_student_attendance) == true){}
            else
            {
                array_push($rows_student_attendance,['row'=>$row->name,'count_students_attendances' => $count_student_attendance]);
                $count_student_attendance = 0;
            }
        }
        
        return response()->json([
            'rows_student_attendance' => $rows_student_attendance
        ]);
        
    }
    public function TodaySalary()
    {
        
        $rows = Row::get()->all();
        $rows_student_salary = [];
        $count_student_salary =0 ;
        $date = '20'.date('y-m-d');
        foreach($rows as $row){   
            foreach($row->Students as $student){
                if($student->Salary != null){
                    foreach($student->Salary as $salary){
                        if($salary->date == $date){
                            $count_student_salary = $count_student_salary +$salary->salary ;
                        }
                        
                    }
                   
                }
            }
            if(in_array($row->name,$rows_student_salary) == true){
                
            }
            else
            {
                array_push($rows_student_salary,['row'=>$row->name,'count_students_salary' => $count_student_salary]);
                $count_student_salary = 0;
            }
            
        }
        return response()->json([
            'rows_student_salary' => $rows_student_salary
        ]);
        
    }
}
