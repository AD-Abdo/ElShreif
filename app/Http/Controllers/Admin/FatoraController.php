<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class FatoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
		$month = now()->month;
		$year = now()->year;
      	$teachers = Teacher::where('payDate','NOT LIKE','%'.$month.'-'.$year.'%')->orWhereNull('payDate')->get()->all();
      	return view('admin.fatora.index',compact('teachers'));
    }

    public function message()
    {
        return [
            'teacher.required' => 'يجب اختيار المدرس',
            'date.required' => 'يجب اختيار التاريخ'
        ];
    }
    public function search(Request $request)
    {
        $request->validate([
            'teacher' => 'required',
            'date' =>'required'
        ],$this->message());
        $date = explode('-',$request->date);
        $year = $date[0];
        $month = $date[1];
        $rows = TeacherAttendance::query()->where('month','=',$month)->where('month','=',$month)
        ->where('teacher_id','=',$request->teacher)->get();

        $teacher = Teacher::find($request->teacher);
        return view('admin.fatora.show',compact('rows','teacher','month','year'));
    }

	public function pay(Request $request)
    {
        
      $teacher = Teacher::find($request->teacher);
	$month = now()->month;
	$year = now()->year;
	$teacher->update([
		'pay' => 1,
		'payDate' => $month.'-'.$year,
	]);	
            
	return redirect()->route('admin.fatora.index')->with('success','تم دفع فاتورة المدرس  '.$teacher->User->name.' على النظام بنجاح');
}

}
