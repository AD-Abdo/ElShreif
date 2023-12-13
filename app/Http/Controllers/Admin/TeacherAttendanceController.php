<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create','show']); 
    }
    public function message()
    {
        return[
            'teacher.required' => 'يجب اختيار المدرس قبل حفظ البيانات',
            'date.required' => 'يجب تحديد تاريخ حضور المدرس',
        ];
    }
    public function index()
    {
        $search = null;
        $rows = TeacherAttendance::latest()->paginate(10);
        $teachers_count = count(Teacher::get()->all());
        return view('admin.teacher_attendance.index',compact('rows','search','teachers_count','search'));
    }

    public function create()
    {
        $teachers = Teacher::get()->all();
        $teachers_count = count(Teacher::get()->all());
        return view('admin.teacher_attendance.create',compact('teachers','teachers_count'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher' => 'required',
            'date' => 'required'
        ],$this->message());

        try{
            $date = explode('-',$request->date);
            $row = new TeacherAttendance();
            $row->teacher_id = $request->teacher;
            $row->comment = $request->comment;
            $row->date = $request->date;
            $row->user_create = Auth::user()->id;

            $row->salary = $request->salary;
            $row->year = $date[0];
            $row->month = $date[1];
            $row->save();
            return redirect()->route('admin.teacher_attendance.create')->with('success','تم حضور المدرس وحفظ البيانات بنجاح');
        }
        catch(Exception $ex){
            return redirect()->route('admin.teacher_attendance.create')->with('error',$ex);
        }
    }

    public function show($id)
    {
        $teachers = Teacher::get()->all();
        $row = TeacherAttendance::findOrFail($id);
        return view('admin.teacher_attendance.show',compact('row','teachers'));
    }
    public function edit($id)
    {
        $teachers = Teacher::get()->all();
        $row = TeacherAttendance::findOrFail($id);
        return view('admin.teacher_attendance.edit',compact('row','teachers'));
    }
    public function update(Request $request,$id)
    {
        $row = TeacherAttendance::findOrFail($id);
        $request->validate([
            'teacher' => 'required'
        ]);
        if($row->teacher_id == $request->teacher && $row->comment == $request->comment && $row->salary == $request->salary){
            return redirect()->route('admin.teacher_attendance.edit',$row->id)->with('error','لم يتم تغيير بيانات حضور المدرس '.$row->Teacher->name.' لعدم التغيير فى البيانات');
        }else{
            $row->teacher_id = $request->teacher;
            $row->comment = $request->comment;
            $row->salary = $request->salary;
            $row->update();
            return redirect()->route('admin.teacher_attendance.edit',$row->id)->with('success','تم تعديل بيانات حضور المدرس '.$row->Teacher->name.' فى النظام بنجاح');

        }
    }

    public function destroy($id)
    {
        try{
            $row = TeacherAttendance::findOrFail($id);
            $row->delete();
            return redirect()->route('admin.teacher_attendance.index')->with('success','تم حذف بيانات حضور المدرس : '.$row->Teacher->name.' من النظام بنجاح');
        }   

        catch(Exception $ex){
            return redirect()->route('admin.teacher_attendance.index',$row->id)->with('error','ex');
        }
        
    }
    public function search(Request $request)
    {
        $search = $request->search;
        
        if($search == null ){
            return redirect()->route('admin.teacher_attendance.index');
        }

        else{
            $teachers_count = count(Teacher::get()->all());
            $rows = TeacherAttendance::query()->where('date',$request->search)->paginate(10);
            return view('admin.teacher_attendance.index',compact('rows','search','teachers_count'));
        }
            
    }

}
