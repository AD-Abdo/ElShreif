<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index','search','attendance']); 
    }
    public function message()
    {
        return[
            'student.required' => 'يجب اختيار المدرس قبل حفظ البيانات',
        ];
    }
    public function index()
    {
        $search = null;
        $id = null;
        $rows = StudentAttendance::latest()->paginate(10);
        $student_count = count(Student::get()->all());
        return view('admin.student_attendance.index',compact('rows','search','student_count','id'));
    }
    public function attendance(Request $request)
    {
       
        if($request->id == null){
            
            return redirect()->route('admin.student_attendance.index')->with('error','يجب قراءة باكود الطالب');
        }
        else{
            $student = Student::query()->where('id','=',$request->id)->get();
            if(count($student) == 0){
                return redirect()->route('admin.student_attendance.index')->with('error','هذا الطالب غير مسجل على النظام');
            }
            else{
                $date = '20'.date('y-m-d');

                
                $student = StudentAttendance::query()->where('student_id','=',$request->id)->where('date','=',$date)->first();
                if($student == null){
                    $row = new StudentAttendance();
                    $row->student_id = $request->id;
                    $row->user_create = Auth::user()->id;
                    $row->date = Carbon::now();
                    $row->month = Carbon::now()->month;
                    $row->save();
                    return redirect()->route('admin.student_attendance.index')->with('success','تم حضور الطالب '.$row->Student->name.' على النظام بنجاح');
                }else{
                    return redirect()->route('admin.student_attendance.index')->with('error','تم حضور الطالب فى هذا اليوم مسبقا');

                }
                
            }
        }
    }

    public function destroy($id)
    {
        try{
            $row = StudentAttendance::findOrFail($id);
            $row->delete();
            return redirect()->route('admin.student_attendance.index')->with('success','تم حذف بيانات حضور الطالب : '.$row->Student->name.' من النظام بنجاح');
        }   

        catch(Exception $ex){
            return redirect()->route('admin.student_attendance.index',$row->id)->with('error','ex');
        }
        
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $id = $request->id;
        
         if($search == null && $id != null){
            
                $students = Student::query()->where('name','LIKE','%'.$id.'%')->orWhere('id',$id)->get()->all();
			

			
		    $students_ids = [];
		    foreach($students as $student){
                    array_push($students_ids,$student->id);
                }
                $rows = StudentAttendance::query()->whereIn('student_id',$students_ids)->paginate(10000);
			$student_count = StudentAttendance::query()->whereIn('student_id',$students_ids)->count();
                
               
            
            return view('admin.student_attendance.index',compact('rows','search','student_count','id'));
        }
	else if($search != null && $id != null){

		$students = Student::query()->where('name','LIKE','%'.$id.'%')->orWhere('id',$id)->get()->all();
			

			
		$students_ids = [];
		foreach($students as $student){
                 array_push($students_ids,$student->id);
             }
             $rows = StudentAttendance::query()->whereIn('student_id',$students_ids)->where('date',$search)->paginate(10000);
		$student_count = StudentAttendance::query()->whereIn('student_id',$students_ids)->where('date',$search)->count();

            
            return view('admin.student_attendance.index',compact('rows','search','student_count','id'));
        }
        
        else if($search != null && $id == null){
            $student_count = count(Student::get()->all());
            $rows = StudentAttendance::query()->where('date',$search)->paginate(10);
            return view('admin.student_attendance.index',compact('rows','search','student_count','id'));
        }

        else{
            return redirect()->route('admin.student_attendance.index');
        }
            
    }
}
